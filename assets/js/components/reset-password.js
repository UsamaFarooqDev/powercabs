/**
 * Supabase password recovery, client-side (reset-password.php).
 *
 * Supported entry points -- Supabase's email templates produce one or the
 * other depending on how the template is written, so both are handled:
 *   1. /reset-password?token_hash=<hash>&type=recovery   ({{ .TokenHash }})
 *   2. /reset-password#access_token=..&refresh_token=..  ({{ .ConfirmationURL }})
 *
 * The token is only redeemed when the user actually submits a new password,
 * not on page load -- mail scanners and link previewers routinely fetch every
 * URL in an email, and verifying on load would let them burn the (single-use)
 * token before the real person ever clicks it.
 *
 * The @supabase/supabase-js bundle is injected from here rather than sitting
 * in a <script src> in the markup: pjax.js re-executes every script inside
 * <main> after a content swap, which would re-load the SDK and redefine
 * window.supabase on each visit. Same reasoning as the Google Maps SDK skip
 * in pjax.js.
 */
(function () {
  var root = document.getElementById('pcResetPassword');
  if (!root) return;

  var SDK_URL = 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2/dist/umd/supabase.js';
  var MIN_LENGTH = 8;

  var loadingEl = document.getElementById('pcResetLoading');
  var formWrap = document.getElementById('pcResetFormWrap');
  var doneEl = document.getElementById('pcResetDone');
  var invalidEl = document.getElementById('pcResetInvalid');
  var invalidTextEl = document.getElementById('pcResetInvalidText');
  var form = document.getElementById('pcResetForm');
  var newInput = document.getElementById('pcResetNew');
  var confirmInput = document.getElementById('pcResetConfirm');
  var rulesEl = document.getElementById('pcResetRules');
  var errorEl = document.getElementById('pcResetError');
  var emailEl = document.getElementById('pcResetEmail');

  function showPanel(el) {
    [loadingEl, formWrap, doneEl, invalidEl].forEach(function (panel) {
      if (panel) panel.classList.toggle('d-none', panel !== el);
    });
  }

  function showError(message) {
    if (!errorEl) return;
    errorEl.textContent = message;
    errorEl.classList.remove('d-none');
  }

  function clearError() {
    if (!errorEl) return;
    errorEl.textContent = '';
    errorEl.classList.add('d-none');
  }

  function showInvalid(message) {
    if (message && invalidTextEl) invalidTextEl.textContent = message;
    showPanel(invalidEl);
  }

  /* ---------- Read the credentials Supabase put in the URL ---------- */

  var query = new URLSearchParams(window.location.search);
  var hash = new URLSearchParams((window.location.hash || '').replace(/^#/, ''));

  // An expired or already-used link comes back as an error in the fragment
  // rather than as a usable token.
  if (hash.get('error') || hash.get('error_description')) {
    showInvalid(
      hash.get('error_code') === 'otp_expired'
        ? 'This reset link has expired. Open the PowerCabs app and tap Forgot Password to get a fresh one.'
        : hash.get('error_description') ||
            'This reset link is no longer valid. Please request a new one from the app.'
    );
    return;
  }

  var tokenHash = query.get('token_hash') || query.get('token');
  var accessToken = hash.get('access_token');
  var refreshToken = hash.get('refresh_token');
  var linkType = query.get('type') || hash.get('type') || 'recovery';

  if (!tokenHash && !(accessToken && refreshToken)) {
    showInvalid();
    return;
  }

  var supabaseUrl = root.dataset.supabaseUrl || '';
  var supabaseKey = root.dataset.supabaseKey || '';
  if (!supabaseUrl || !supabaseKey) {
    showInvalid('Password resets are temporarily unavailable. Please contact support so we can help you directly.');
    return;
  }

  /* ---------- Load the SDK, then show the form ---------- */

  function loadSdk() {
    if (window.supabase && window.supabase.createClient) return Promise.resolve();
    if (window.pcSupabaseSdkPromise) return window.pcSupabaseSdkPromise;

    window.pcSupabaseSdkPromise = new Promise(function (resolve, reject) {
      var script = document.createElement('script');
      script.src = SDK_URL;
      script.async = true;
      script.onload = resolve;
      script.onerror = function () {
        window.pcSupabaseSdkPromise = null; // let a later visit retry
        reject(new Error('Could not load the Supabase SDK'));
      };
      document.head.appendChild(script);
    });
    return window.pcSupabaseSdkPromise;
  }

  var client = null;

  loadSdk()
    .then(function () {
      client = window.supabase.createClient(supabaseUrl, supabaseKey, {
        auth: {
          // The recovery session exists only to run one updateUser() call --
          // never write it to storage, and never let the SDK parse the URL
          // itself (we redeem the token explicitly, on submit).
          persistSession: false,
          autoRefreshToken: false,
          detectSessionInUrl: false,
        },
      });
      showPanel(formWrap);
      if (newInput) newInput.focus();
    })
    .catch(function () {
      showInvalid('We could not reach our secure password service. Check your connection and open the link again.');
    });

  /* ---------- Live requirement hints ---------- */

  function updateRules() {
    if (!rulesEl) return;
    var password = newInput ? newInput.value : '';
    var confirmation = confirmInput ? confirmInput.value : '';
    var state = {
      length: password.length >= MIN_LENGTH,
      match: password !== '' && password === confirmation,
    };

    rulesEl.querySelectorAll('[data-rule]').forEach(function (item) {
      var met = !!state[item.dataset.rule];
      item.classList.toggle('is-met', met);
      var icon = item.querySelector('i');
      if (icon) icon.className = met ? 'bi bi-check-circle-fill' : 'bi bi-circle';
    });
  }

  [newInput, confirmInput].forEach(function (input) {
    if (!input) return;
    input.addEventListener('input', function () {
      clearError();
      updateRules();
    });
  });
  updateRules();

  /* ---------- Show / hide password ---------- */

  root.querySelectorAll('.pc-reset-toggle').forEach(function (button) {
    button.addEventListener('click', function () {
      var input = document.getElementById(button.dataset.target);
      if (!input) return;
      var reveal = input.type === 'password';
      input.type = reveal ? 'text' : 'password';
      button.setAttribute('aria-label', reveal ? 'Hide password' : 'Show password');
      var icon = button.querySelector('i');
      if (icon) icon.className = reveal ? 'bi bi-eye-slash' : 'bi bi-eye';
    });
  });

  /* ---------- Submit ---------- */

  /** Supabase's raw auth errors are written for developers -- translate the ones users actually hit. */
  function friendlyError(message) {
    var text = (message || '').toLowerCase();
    if (text.indexOf('expired') !== -1 || text.indexOf('invalid') !== -1) {
      return 'This reset link has expired or has already been used. Please request a new one from the app.';
    }
    if (text.indexOf('should be different') !== -1) {
      return 'Please choose a password you have not used on this account before.';
    }
    if (text.indexOf('weak') !== -1 || text.indexOf('password should') !== -1) {
      return message; // Supabase already spells out the project's password policy here.
    }
    if (text.indexOf('rate limit') !== -1 || text.indexOf('too many') !== -1) {
      return 'Too many attempts. Please wait a minute and try again.';
    }
    return 'Sorry, we could not update your password. Please try again or contact support.';
  }

  if (form) {
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      clearError();

      var password = newInput ? newInput.value : '';
      var confirmation = confirmInput ? confirmInput.value : '';

      if (password.length < MIN_LENGTH) {
        showError('Your new password must be at least ' + MIN_LENGTH + ' characters long.');
        return;
      }
      if (password !== confirmation) {
        showError('The two passwords do not match.');
        return;
      }
      if (!client) {
        showError('Still getting things ready -- please try again in a moment.');
        return;
      }

      var submitBtn = form.querySelector('button[type="submit"]');
      var restoreBtn = window.pcSetButtonBusy ? window.pcSetButtonBusy(submitBtn) : null;
      if (!restoreBtn && submitBtn) {
        submitBtn.disabled = true;
        restoreBtn = function () {
          submitBtn.disabled = false;
        };
      }

      Promise.resolve()
        .then(function () {
          // Redeem the single-use link into a short-lived recovery session.
          return tokenHash
            ? client.auth.verifyOtp({ type: linkType, token_hash: tokenHash })
            : client.auth.setSession({ access_token: accessToken, refresh_token: refreshToken });
        })
        .then(function (result) {
          if (result.error) throw result.error;

          var user = result.data && result.data.user;
          if (user && user.email && emailEl) emailEl.textContent = user.email;

          return client.auth.updateUser({ password: password });
        })
        .then(function (result) {
          if (result.error) throw result.error;

          // Don't leave a usable session sitting in this tab afterwards.
          return client.auth.signOut().catch(function () {});
        })
        .then(function () {
          showPanel(doneEl);
          if (window.pcToast) window.pcToast('Your password has been updated.', 'success');
        })
        .catch(function (error) {
          showError(friendlyError(error && error.message));
        })
        .finally(function () {
          if (restoreBtn) restoreBtn();
        });
    });
  }
})();

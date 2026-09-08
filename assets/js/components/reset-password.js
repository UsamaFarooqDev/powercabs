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

  // Inline-SVG path data, swapped in place instead of swapping an icon-font
  // classname (Bootstrap Icons is gone). One <path> for the rule bullets,
  // full innerHTML for the eye since its two states differ in shape count.
  var PATH_CIRCLE = 'M8 15A7 7 0 118 1a7 7 0 010 14zm0 1A8 8 0 108 0a8 8 0 000 16z';
  var PATH_CHECK =
    'M16 8A8 8 0 110 8a8 8 0 0116 0zm-3.97-3.03a.75.75 0 00-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 10-1.06 1.06L6.97 11.03a.75.75 0 001.079-.02l3.992-4.99a.75.75 0 00-.01-1.05z';
  var PATH_EYE =
    '<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.13 13.13 0 011.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0114.828 8a13.13 13.13 0 01-1.66 2.043C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 011.172 8z"/><path d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z"/>';
  var PATH_EYE_SLASH =
    '<path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 00-2.79.588l.77.771A5.944 5.944 0 018 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0114.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/><path d="M11.297 9.176a3.5 3.5 0 00-4.474-4.474l.823.823a2.5 2.5 0 012.829 2.829l.822.822zm-2.943 1.299l.822.822a3.5 3.5 0 01-4.474-4.474l.823.823a2.5 2.5 0 002.829 2.829z"/><path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 001.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 018 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709z"/><path d="M13.646 14.354l-12-12 .708-.708 12 12-.708.707z"/>';
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
      if (panel) panel.classList.toggle('tw-hidden', panel !== el);
    });
  }

  function showError(message) {
    if (!errorEl) return;
    errorEl.textContent = message;
    errorEl.classList.remove('tw-hidden');
  }

  function clearError() {
    if (!errorEl) return;
    errorEl.textContent = '';
    errorEl.classList.add('tw-hidden');
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
      var icon = item.querySelector('.pc-icon path');
      if (icon) icon.setAttribute('d', met ? PATH_CHECK : PATH_CIRCLE);
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
      var icon = button.querySelector('.pc-icon');
      if (icon) icon.innerHTML = reveal ? PATH_EYE_SLASH : PATH_EYE;
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

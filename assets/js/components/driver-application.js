/**
 * Drive page: the eight-step driver application.
 *
 * Progressive enhancement, not a takeover. The markup in
 * components/drive/join-family-form.php renders all eight fieldsets; this file
 * hides every one but the current step and wires the three points where the
 * browser has to talk to /driver-apply:
 *
 *   step 1 -> `start`   validates the details and emails a 6-digit code
 *   step 2 -> `verify`  checks that code
 *   files  -> `upload`  one request per file, as it is chosen
 *   step 8 -> `submit`  creates the account and writes the drivers row
 *
 * Steps 3-7 are validated locally and cost no request, so the applicant only
 * waits where something real is happening.
 *
 * WHY THE FILES GO UP IMMEDIATELY. Seven files held back to the end would make
 * the final submit a ~35MB multipart POST, which is over the default
 * post_max_size on most shared hosting -- it would fail late, after the
 * applicant had filled in everything. Sending each file as it is picked keeps
 * every request small and reports a bad file while the applicant is still
 * looking at it.
 *
 * PJAX NOTE -- this is a page-specific <script src> inside <main>, so pjax.js
 * re-executes the whole file on every visit to /drive. Every listener below is
 * attached to a node inside the form, and those are destroyed when PJAX
 * replaces <main>'s innerHTML, so the listeners die with them. Nothing here
 * touches window or document, and nothing sets a timer. Keep it that way: a
 * document-level listener added here would stack up one per navigation.
 */
(function () {
  var LAST_STEP = 8;

  function initDriverApplication() {
    var form = document.querySelector('[data-driver-app]');
    if (!form) return;

    var steps = form.querySelectorAll('[data-app-step]');
    if (steps.length !== LAST_STEP) return;

    var bar = form.querySelector('[data-app-bar]');
    var count = form.querySelector('[data-app-count]');
    var hint = form.querySelector('[data-app-hint]');
    var errorBox = form.querySelector('[data-app-error]');
    var back = form.querySelector('[data-app-back]');
    var next = form.querySelector('[data-app-next]');
    var nextLabel = form.querySelector('[data-app-next-label]');
    var done = form.querySelector('[data-app-done]');
    var current = 1;
    var busy = false;

    var HINTS = {
      1: "Add PowerCabs to your driving — you don't necessarily have to leave other platforms.",
      2: 'Check your inbox — the code can take a moment to arrive.',
      3: 'Choose the password for your Driver app account.',
      4: 'Add a profile photo so passengers recognise you at pickup.',
      5: 'Tell us about the vehicle you will be driving.',
      6: 'Your driving and NTA licence details.',
      7: 'Upload all six documents to continue.',
      8: 'Last step — set your preferences and submit.',
    };

    function showMessage(message, isOk) {
      errorBox.textContent = message;
      errorBox.classList.toggle('is-ok', !!isOk);
      errorBox.classList.add('is-shown');
      // The message replaces the panel's own guidance, so move focus to it --
      // otherwise a screen reader user tabs on past the reason it failed.
      errorBox.setAttribute('tabindex', '-1');
      errorBox.focus({ preventScroll: true });
    }

    function showError(message) {
      showMessage(message, false);
    }

    function clearError() {
      errorBox.textContent = '';
      errorBox.classList.remove('is-shown', 'is-ok');
    }

    function setBusy(state, label) {
      busy = state;
      next.disabled = state;
      next.classList.toggle('tw-opacity-60', state);
      nextLabel.textContent = label || (current === LAST_STEP ? 'Submit application' : 'Continue');
    }

    function render() {
      for (var i = 0; i < steps.length; i++) {
        steps[i].hidden = Number(steps[i].getAttribute('data-app-step')) !== current;
      }
      bar.style.width = Math.round((current / LAST_STEP) * 100) + '%';
      count.textContent = 'Step ' + current + ' of ' + LAST_STEP;
      hint.textContent = HINTS[current];
      back.classList.toggle('is-shown', current > 1);
      // Step 3 is the first one after the address is verified. Going back into
      // the code panel from there would offer to re-verify something already
      // verified, so the door closes behind it.
      back.disabled = current === 3;
      back.classList.toggle('tw-opacity-40', current === 3);
      nextLabel.textContent = current === LAST_STEP ? 'Submit application' : 'Continue';
      clearError();
    }

    function post(body) {
      return fetch(form.getAttribute('action'), {
        method: 'POST',
        body: body,
        credentials: 'same-origin',
        headers: { Accept: 'application/json' },
      })
        .then(function (res) {
          return res.json().catch(function () {
            return { ok: false, error: 'Something went wrong. Please try again.' };
          });
        })
        .catch(function () {
          return { ok: false, error: 'We could not reach the server. Check your connection and try again.' };
        });
    }

    /** Native validity for the visible panel only -- hidden steps never block. */
    function localValid() {
      var panel = form.querySelector('[data-app-step="' + current + '"]');
      var fields = panel.querySelectorAll('input, select, textarea');
      for (var i = 0; i < fields.length; i++) {
        if (!fields[i].checkValidity()) {
          fields[i].reportValidity();
          return false;
        }
      }
      if (current === 3) {
        var pw = form.querySelector('#daPassword');
        var pw2 = form.querySelector('#daPassword2');
        if (pw.value !== pw2.value) {
          showError('Those passwords do not match.');
          return false;
        }
      }
      return true;
    }

    /* ------------------------------------------------- reveal password */
    form.querySelectorAll('[data-app-reveal]').forEach(function (button) {
      var field = form.querySelector('#' + button.getAttribute('data-app-reveal'));
      if (!field) return;
      var eye = button.querySelector('[data-reveal-show]');
      var eyeOff = button.querySelector('[data-reveal-hide]');

      button.addEventListener('click', function () {
        var reveal = field.type === 'password';
        field.type = reveal ? 'text' : 'password';
        eye.classList.toggle('tw-hidden', reveal);
        eyeOff.classList.toggle('tw-hidden', !reveal);
        button.setAttribute('aria-pressed', reveal ? 'true' : 'false');
        button.setAttribute('aria-label', reveal ? 'Hide password' : 'Show password');
        // Clicking the button takes focus off the field; hand it back with the
        // caret at the end, so revealing does not cost you your place.
        var end = field.value.length;
        field.focus();
        try {
          field.setSelectionRange(end, end);
        } catch (err) {
          // Older engines refuse setSelectionRange on some input types; the
          // focus above is the part that matters.
        }
      });
    });

    /* ------------------------------------------------------------ uploads */
    var uploaded = {};

    form.querySelectorAll('[data-app-upload]').forEach(function (input) {
      input.addEventListener('change', function () {
        var file = input.files && input.files[0];
        if (!file) return;
        var slot = input.getAttribute('data-app-upload');
        var row = form.querySelector('[data-app-doc="' + slot + '"]');
        var state = row ? row.querySelector('[data-app-doc-state]') : null;

        clearError();
        if (state) state.textContent = 'Uploading…';
        setBusy(true, 'Uploading…');

        var body = new FormData();
        body.append('action', 'upload');
        body.append('slot', slot);
        body.append('file', file);

        post(body).then(function (res) {
          setBusy(false);
          if (!res.ok) {
            if (state) state.textContent = 'Not uploaded';
            input.value = '';
            showError(res.error || 'That upload failed. Please try again.');
            return;
          }
          uploaded[slot] = res.url;
          if (state) {
            state.textContent = file.name;
            state.classList.remove('tw-text-ink/50');
            state.classList.add('tw-text-[#146c43]', 'tw-font-semibold');
          }
          if (slot === 'profile') {
            var avatar = form.querySelector('[data-app-avatar]');
            if (avatar) {
              // Object URL rather than the Supabase one: it is already in
              // memory, so the preview does not wait on a round trip.
              avatar.innerHTML = '';
              var img = document.createElement('img');
              img.src = URL.createObjectURL(file);
              img.alt = '';
              img.className = 'tw-h-full tw-w-full tw-object-cover';
              avatar.appendChild(img);
            }
          }
        });
      });
    });

    /* -------------------------------------------------------------- steps */
    function advance() {
      current += 1;
      render();
      form.scrollIntoView({ block: 'nearest', behavior: 'smooth' });
    }

    function handleNext() {
      if (busy) return;
      clearError();
      if (!localValid()) return;

      if (current === 1) {
        setBusy(true, 'Sending code…');
        var start = new FormData();
        start.append('action', 'start');
        ['full_name', 'email', 'phone', 'referral'].forEach(function (name) {
          start.append(name, form.querySelector('[name="' + name + '"]').value);
        });
        post(start).then(function (res) {
          setBusy(false);
          if (!res.ok) return showError(res.error);
          var shown = form.querySelector('[data-app-email]');
          if (shown) shown.textContent = res.email;
          advance();
        });
        return;
      }

      if (current === 2) {
        setBusy(true, 'Checking…');
        var verify = new FormData();
        verify.append('action', 'verify');
        verify.append('code', form.querySelector('#daCode').value);
        post(verify).then(function (res) {
          setBusy(false);
          if (!res.ok) return showError(res.error);
          advance();
        });
        return;
      }

      if (current === 4) {
        if (!uploaded.profile) return showError('Please add a profile photo to continue.');
        advance();
        return;
      }

      if (current === 7) {
        var missing = [];
        form.querySelectorAll('[data-app-doc]').forEach(function (row) {
          var slot = row.getAttribute('data-app-doc');
          if (!uploaded[slot]) {
            missing.push(row.querySelector('span span').textContent);
          }
        });
        if (missing.length) return showError('Still to upload: ' + missing.join(', ') + '.');
        advance();
        return;
      }

      if (current === LAST_STEP) {
        setBusy(true, 'Submitting…');
        var body = new FormData(form);
        body.append('action', 'submit');
        post(body).then(function (res) {
          setBusy(false);
          if (!res.ok) return showError(res.error);
          // Swap the whole form for the confirmation: re-submitting would only
          // fail now that the session has been cleared server-side.
          for (var i = 0; i < steps.length; i++) steps[i].hidden = true;
          next.parentNode.hidden = true;
          done.classList.add('is-shown');
          bar.style.width = '100%';
          count.textContent = 'Complete';
          hint.textContent = 'Welcome to PowerCabs.';
          done.setAttribute('tabindex', '-1');
          done.focus({ preventScroll: true });
        });
        return;
      }

      advance();
    }

    next.addEventListener('click', function (event) {
      event.preventDefault();
      handleNext();
    });

    form.addEventListener('submit', function (event) {
      event.preventDefault();
      handleNext();
    });

    back.addEventListener('click', function () {
      if (busy || current === 1 || current === 3) return;
      current -= 1;
      render();
    });

    var resend = form.querySelector('[data-app-resend]');
    if (resend) {
      resend.addEventListener('click', function () {
        if (busy) return;
        clearError();
        setBusy(true, 'Sending…');
        var again = new FormData();
        again.append('action', 'start');
        ['full_name', 'email', 'phone', 'referral'].forEach(function (name) {
          again.append(name, form.querySelector('[name="' + name + '"]').value);
        });
        post(again).then(function (res) {
          setBusy(false);
          if (!res.ok) return showError(res.error);
          showMessage('A new code is on its way.', true);
        });
      });
    }

    form.setAttribute('data-ready', 'true');
    render();
  }

  initDriverApplication();
})();

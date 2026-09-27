/**
 * Tailwind build config. This is the single source of truth for the site's
 * theme -- includes/tailwind.php just links the compiled output.
 *
 * The compiled file (assets/css/tailwind.css) is COMMITTED, so production
 * still serves plain files with no toolchain. The build is a dev-time step;
 * there is deliberately no package.json, so it runs as a one-off npx after
 * adding or changing any tw- class (swap --minify for --watch while working):
 *
 *   npx tailwindcss@3.4.19 -c tailwind.config.js -i assets/css/tailwind.src.css -o assets/css/tailwind.css --minify
 */
module.exports = {
  // Class names also live inside JS string literals (custom-select.js,
  // custom-datetime.js, toast.js, pjax.js, ajax-forms.js, ui.js build their
  // own markup), so those are scanned too, not just the PHP.
  content: ['./**/*.php', './assets/js/**/*.js', '!./node_modules/**'],

  // Two places compose a class name from a PHP variable, so the scanner can
  // never see the finished string. Both are enumerable, so they are listed
  // here explicitly -- if either gains a new value, add it here or the
  // utility silently will not exist.
  safelist: [
    'tw-max-w-[280px]', // components/shared/app-mockup.php default
    'tw-max-w-[300px]', // components/home/download-app.php
    // loyalty-program.php renders one tier card per colour, and composes
    // three separate utilities from that colour -- all nine are listed
    // because the scanner only ever sees `<?= $tierColor ?>`.
    'tw-text-[#8a8f98]',
    'tw-text-[#c99a2e]',
    'tw-text-[#cd7f32]',
    'tw-bg-[color-mix(in_srgb,#8a8f98_16%,white)]',
    'tw-bg-[color-mix(in_srgb,#c99a2e_16%,white)]',
    'tw-bg-[color-mix(in_srgb,#cd7f32_16%,white)]',
    'tw-shadow-[inset_0_0_0_2px_color-mix(in_srgb,#8a8f98_35%,transparent)]',
    'tw-shadow-[inset_0_0_0_2px_color-mix(in_srgb,#c99a2e_35%,transparent)]',
    'tw-shadow-[inset_0_0_0_2px_color-mix(in_srgb,#cd7f32_35%,transparent)]',
  ],

  prefix: 'tw-',

  // base.css owns the global element styles (it hand-rolls a reset), so
  // Preflight stays off. Consequence: nothing resets border-style, so a
  // border-width utility needs an explicit tw-border-solid next to it, and a
  // <button> needs tw-appearance-none tw-border-0 to shed its native chrome.
  corePlugins: { preflight: false },

  theme: {
    extend: {
      fontFamily: {
        // Same stack as --pc-font-family in variables.css, including the
        // metric-matched fallback declared in base.css.
        sans: ['DM Sans', 'DM Sans Fallback', 'ui-sans-serif', 'system-ui', '-apple-system', 'Segoe UI', 'sans-serif'],
      },
      // Names stay FLAT (power, ink, paper) rather than moving to a nested
      // power.orange / power.ink scale. The redesign brief shows a nested
      // example, but renaming would rewrite every colour utility in 30 pages
      // in the same commit as the redesign, making every diff unreadable --
      // and this file already warns that the analogous tw- prefix migration
      // belongs in a commit of its own. The VALUES are rebranded here; the
      // names can follow later, mechanically, on their own.
      colors: {
        // Sampled from the logo (#f37a20) rather than carried over from the
        // old template's redder #e8590c.
        power: '#f97316', // --pc-orange
        powerdark: '#d85f0b', // --pc-orange-dark
        powersoft: '#fff4ea', // --pc-orange-soft, for tinted panels
        // Was its own brighter orange. Aliased to the brand orange so the
        // pages still using it do not show a second, competing accent.
        powerlight: '#f97316',

        ink: '#111111', // --pc-ink
        'ink-soft': '#252525', // --pc-ink-soft
        surface: '#f7f7f5', // --pc-surface, the default off-white band
        'surface-warm': '#fbf8f4', // --pc-surface-warm
        hairline: '#e7e5e2', // --pc-border; `border` is a Tailwind utility name
        muted: '#6b6b6b', // --pc-muted

        success: '#17834b', // --pc-success
        info: '#2563eb', // --pc-info

        // Retained for the pages not yet migrated; aliases, not new colours.
        paper: '#fbf8f4',
        'paper-soft': '#f7f7f5',
        peach: '#fff4ea',
        'power10-red': '#d7263d',
      },
      maxWidth: {
        // The brief's editorial widths. `content` is the marketing container,
        // `reading` the measure for long-form legal and support copy.
        content: '1440px',
        reading: '760px',
      },
      borderRadius: {
        card: '1.5rem',
        panel: '2rem',
        pill: '999px',
      },
      // Every animation the site uses. Keyframes live here rather than in a
      // stylesheet because Tailwind only emits a @keyframes block when a
      // matching animate-* utility is generated -- so an arbitrary
      // [animation:name_...] utility would reference a name that never gets
      // defined. Always use the named tw-animate-pc-* utilities, paired with
      // an arbitrary [animation-delay:...] when staggering.
      keyframes: {
        'pc-float': {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-8px)' },
        },
        'pc-fade-up': {
          from: { opacity: '0', transform: 'translateY(16px)' },
          to: { opacity: '1', transform: 'translateY(0)' },
        },
        'pc-fade-in-sm': {
          from: { opacity: '0', transform: 'translateY(6px)' },
          to: { opacity: '1', transform: 'translateY(0)' },
        },
        'pc-glow-pulse': {
          '0%, 100%': { opacity: '0.65', transform: 'scale(1)' },
          '50%': { opacity: '1', transform: 'scale(1.06)' },
        },
        'pc-marquee': {
          from: { transform: 'translateX(0)' },
          to: { transform: 'translateX(-50%)' },
        },
        'pc-dot-pulse': {
          '0%, 100%': { transform: 'scale(1)', opacity: '1' },
          '50%': { transform: 'scale(1.6)', opacity: '0.5' },
        },
      },
      animation: {
        'pc-float': 'pc-float 6s ease-in-out infinite',
        'pc-float-fast': 'pc-float 5s ease-in-out infinite',
        'pc-fade-up': 'pc-fade-up 0.7s ease both',
        'pc-fade-up-slow': 'pc-fade-up 0.9s ease both',
        'pc-fade-in-sm': 'pc-fade-in-sm 0.35s ease both',
        'pc-glow-pulse': 'pc-glow-pulse 7s ease-in-out infinite',
        'pc-marquee': 'pc-marquee 36s linear infinite',
        'pc-dot-pulse': 'pc-dot-pulse 1.8s ease-in-out infinite',
      },
    },
  },
};

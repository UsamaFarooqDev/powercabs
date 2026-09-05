<!-- Global page loader. `pc-loader-hidden` is the only bare classname left --
     it is the contract page-loader.js toggles (and nothing else styles it);
     everything visual is Tailwind on this markup.

     The hidden state is opacity + pointer-events rather than `visibility`,
     so the fade actually plays out instead of the overlay snapping away the
     instant the class lands. It is aria-hidden either way, and inert once
     faded, so nothing can be clicked or focused through it.

     Light frosted scrim rather than the old dark one: this sits over white
     and cream pages, so a near-white veil reads as the page settling rather
     than as a modal blocking it. -->
<div class="tw-fixed tw-inset-0 tw-z-[2000] tw-flex tw-flex-col tw-items-center tw-justify-center tw-gap-4 tw-bg-white/80 tw-backdrop-blur-md tw-opacity-100 tw-transition-opacity tw-duration-[350ms] tw-ease-out [&.pc-loader-hidden]:tw-pointer-events-none [&.pc-loader-hidden]:tw-opacity-0"
  id="pcPageLoader" aria-hidden="true">
  <!-- Two stacked rings: a static hairline track plus one spinning arc, so
       the motion is a single sweeping quarter rather than a thick chasing
       donut. motion-reduce swaps the sweep for a slow pulse. -->
  <span class="tw-relative tw-flex tw-h-11 tw-w-11 tw-items-center tw-justify-center" role="status" aria-label="Loading">
    <span class="tw-absolute tw-inset-0 tw-rounded-full tw-border-2 tw-border-solid tw-border-power/[0.15]"></span>
    <span class="tw-absolute tw-inset-0 tw-animate-spin tw-rounded-full tw-border-2 tw-border-solid tw-border-transparent tw-border-t-powerlight motion-reduce:tw-animate-pulse motion-reduce:tw-border-powerlight"></span>
  </span>
  <span class="tw-text-sm tw-font-medium tw-tracking-[0.03em] tw-text-ink/70">Loading&hellip;</span>
</div>

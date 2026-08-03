/*
  Video tutorial grid (FAQ page): each card shows a muted, controls-less
  <video preload="metadata"> (the browser renders its first frame as a
  free thumbnail, no separate poster image needed) with a play button
  overlay. Clicking the button reveals native controls, unmutes, and
  starts playback -- keeps the initial page light since only metadata is
  fetched for the 8 clips until one is actually played.
*/
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".pc-tutorial-card").forEach((card) => {
    const video = card.querySelector("video");
    const playBtn = card.querySelector(".pc-tutorial-play-btn");
    if (!video || !playBtn) return;

    playBtn.addEventListener("click", () => {
      video.muted = false;
      video.controls = true;
      video.play();
      playBtn.classList.add("d-none");
      const label = card.querySelector(".pc-tutorial-card-label");
      if (label) label.classList.add("d-none");
    });

    video.addEventListener("pause", () => {
      if (video.currentTime === 0 || video.ended) {
        playBtn.classList.remove("d-none");
        const label = card.querySelector(".pc-tutorial-card-label");
        if (label) label.classList.remove("d-none");
      }
    });
  });
});

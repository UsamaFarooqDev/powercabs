function pcInitVideoTutorials() {
  document.querySelectorAll(".pc-tutorial-card").forEach((card) => {
    const video = card.querySelector("video");
    const playBtn = card.querySelector(".pc-tutorial-play-btn");
    if (!video || !playBtn) return;

    playBtn.addEventListener("click", () => {
      video.muted = false;
      video.controls = true;
      video.play();
      playBtn.classList.add("tw-hidden");
      const label = card.querySelector(".pc-tutorial-card-label");
      if (label) label.classList.add("tw-hidden");
    });

    video.addEventListener("pause", () => {
      if (video.currentTime === 0 || video.ended) {
        playBtn.classList.remove("tw-hidden");
        const label = card.querySelector(".pc-tutorial-card-label");
        if (label) label.classList.remove("tw-hidden");
      }
    });
  });
}

if (document.readyState !== "loading") {
  pcInitVideoTutorials();
} else {
  document.addEventListener("DOMContentLoaded", pcInitVideoTutorials);
}

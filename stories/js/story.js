let noStory = false;
if (!story) {
    noStory = true;
}

const storyPreviewContainer = document.querySelector(".storyPreviewContainer");
const storyPreviewProgressContainer = storyPreviewContainer.querySelector(
    ".storyPreviewProgressContainer"
);
const storyPreview = storyPreviewContainer.querySelector(".storyPreview");
const storyPreviewProgress = storyPreviewContainer.querySelector(
    ".storyPreviewProgress"
);
const nextBtn = storyPreviewContainer.querySelector(".storyPreviewNextButton");
const prevBtn = storyPreviewContainer.querySelector(".storyPreviewPrevButton");
const replyInput = storyPreviewContainer.querySelector(
    "form > input[name='reply']"
);

let paused = false;
let progressPercentage = 0;
let interval;
init();

function init() {
    storyPreviewProgress.style.width = "0";

    interval = setInterval(animateProgessBar, 50);

    replyInput.addEventListener("focus", (e) => {
        paused = true;
    });
    replyInput.addEventListener("blur", (e) => {
        paused = false;
    });
}

function animateProgessBar() {
    if (paused) return;
    if (progressPercentage < 100) {
        storyPreviewProgress.style.width = `${progressPercentage}%`;
        progressPercentage += 0.67;
    } else {
        clearInterval(interval);
        nextBtn?.click();
        // progressPercentage = 0
    }
}

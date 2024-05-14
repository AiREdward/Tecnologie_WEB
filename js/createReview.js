const review_box = document.getElementById('review-box');
const submit_button = document.getElementById('submit-button');

submit_button.disabled = true;

function checkIfReviewIsNotEmpty() {
    return review_box.value.trim().length !== 0;
}

review_box.addEventListener('input', function () {
    submit_button.disabled = !checkIfReviewIsNotEmpty();
});
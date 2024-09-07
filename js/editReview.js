const edit_review_box = document.getElementById('review-box');
const submit_edit_button = document.getElementById('submit-button');
const delete_button = document.getElementById('delete-button');

const review_id = document.getElementById('review-id').innerHTML;

function getXMLHttp() {
    let xmlHttp;
    try {
        xmlHttp = new XMLHttpRequest();
    } catch(e) {
        try {
            xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch(e) {
            try {
                xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
            } catch(e) {
                alert("Your browser does not support AJAX!");
                return false;
            }
        }
    }
    return xmlHttp;
}

function checkIfEditReviewIsNotEmpty() {
    return edit_review_box.value.trim().length !== 0;
}

edit_review_box.addEventListener('input', function () {
    submit_edit_button.disabled = !checkIfEditReviewIsNotEmpty();
});

delete_button.addEventListener('click', function() {
    let url = 'utilities/requests/deleteReviewRequest.php?id=' + review_id;
    let xmlHttp = getXMLHttp();

    xmlHttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            window.location.href = 'user_area.php';
        }
    }

    xmlHttp.open('GET', url, true);
    xmlHttp.send();
});
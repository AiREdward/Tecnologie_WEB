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

delete_button.addEventListener('click', function() {
    console.log(review_id);

    let url = 'utilities/requests/deleteReviewRequest.php?id=' + review_id;
    let xmlHttp = getXMLHttp();

    xmlHttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            // TODO: add error handling
            window.location.href = 'area_utente.php';
        }
    }

    xmlHttp.open('GET', url, true);
    xmlHttp.send();
});
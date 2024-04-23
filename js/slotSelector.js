const day_selector = document.getElementById('day-selector');
const slot_selector= document.getElementById('slot-selector');
const submit_button = document.getElementById('submit-button');
const room_id = document.getElementById('room-id').innerHTML;

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

day_selector.addEventListener('change', function() {
    let day = day_selector.value;
    let url = 'utilities/requests/getSlotsRequest.php?day=' + day + '&id_room=' + room_id;
    let xmlHttp = getXMLHttp();

    xmlHttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            let slots = JSON.parse(this.responseText);
            let slots_to_remove = slot_selector.options.length;

            for (let i = 1; i < slots_to_remove; i++) {
                slot_selector.options[1].remove();
            }

            for (let i = 0; i < slots.length; i++) {
                let option = document.createElement('option');
                option.value = slots[i];
                option.innerHTML = slots[i].substring(0, 5);
                slot_selector.appendChild(option);
            }

            slot_selector.disabled = false;
        }
    }

    xmlHttp.open('GET', url, true);
    xmlHttp.send();
});

slot_selector.addEventListener('change', function() {
    submit_button.disabled = false;
});

slot_selector.disabled = true;
submit_button.disabled = true;
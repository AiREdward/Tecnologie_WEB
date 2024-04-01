const day_selector = document.getElementById('day-selector');
const slot_selector = document.getElementById('slot-selector');
const delete_button = document.getElementById('delete-button');

let booking_date = document.getElementById('booking-date').innerHTML;
let booking_time = document.getElementById('booking-time').innerHTML;
let booking_user = document.getElementById('booking-user').innerHTML;
let booking_room = document.getElementById('booking-room').innerHTML;

day_selector.value = booking_date;
let option = document.createElement('option');
getSlotsForTheDay();

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

function compareTimes(time1, time2) {
    let [hours1, minutes1, seconds1] = time1.split(':').map(Number);
    let [hours2, minutes2, seconds2] = time2.split(':').map(Number);

    let date1 = new Date();
    date1.setHours(hours1, minutes1, seconds1, 0);

    let date2 = new Date();
    date2.setHours(hours2, minutes2, seconds2, 0);

    if (date1 > date2) {
        return 1;
    } else if (date1 < date2) {
        return -1;
    } else {
        return 0;
    }
}

function insertBookingSlot() {
    let slots = slot_selector.options;
    let slot_to_insert = document.createElement('option');
    slot_to_insert.value = booking_time;
    slot_to_insert.innerHTML = booking_time.substring(0, 5);
    let i = 0;

    // Finds the position of the first slot that is after the booking time
    while (i < slots.length && compareTimes(slots[i].value, booking_time) !== 1) {
        i++;
    }

    slot_selector.insertBefore(slot_to_insert, slots[i]);
    slot_selector.value = booking_time;
}

function getSlotsForTheDay() {
    let day = day_selector.value;
    let url = 'utilities/getSlots.php?day=' + day + '&id_room=' + booking_room;
    let xmlHttp = getXMLHttp();

    xmlHttp.onreadystatechange = function () {
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

            if(day === booking_date) insertBookingSlot();

            slot_selector.disabled = false;
        }
    }

    xmlHttp.open('GET', url, true);
    xmlHttp.send();
}

day_selector.addEventListener('change', getSlotsForTheDay);

delete_button.addEventListener('click', function() {
    let url = 'utilities/deleteBookingRequest.php?day=' + booking_date + '&slot=' + booking_time + '&user=' + booking_user + '&room=' + booking_room;
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
const day_selector = document.getElementById('day-selector');
const slot_selector = document.getElementById('slot-selector');
const submit_button = document.getElementById('submit-button');
const delete_button = document.getElementById('delete-button');

var booking_date = document.getElementById('booking-date').innerHTML;
var booking_time = document.getElementById('booking-time').innerHTML;
var booking_user = document.getElementById('booking-user').innerHTML;
var booking_room = document.getElementById('booking-room').innerHTML;

day_selector.value = booking_date;
slot_selector.value = booking_time;
slot_selector.innerHTML = booking_time;
submit_button.disabled = true;

day_selector.addEventListener('change', function() {
    console.log('day_selector changed');
});
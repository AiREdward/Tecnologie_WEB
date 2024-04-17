<?php
$regex_password = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).{8,128}$/';
$regex_username = '/^\w{1,32}$/';
$regex_phone_number = '/^[0-9]{10}$/';

// Page contained in the navbar
$navbar_pages = [
    'index',
    'area_utente'
];

$access_keys = [
    'index' => 'h',
    'area_utente' => 'u'
];

// TODO: change file names into english
$page_hierarchy = [
    'index' => 'index',
    'area_utente' => 'index',
    'admin' => 'index',
    'login' => 'area_utente',
    'signup' => 'area_utente',
    'logout' => 'area_utente',
    'prenota' => 'index',
    'modifica_prenotazione' => 'area_utente',
    'crea_recensione' => 'area_utente',
    'modifica_recensione' => 'area_utente',
    'amministrazione_stanza' => 'admin'
];

$texts = [
    'it' => [
        // base_layout & page names
        'skip' => 'Salta al contenuto',
        'nav_toggle' => 'apri/chiudi barra navigazione',
        'breadcrumb' => 'Ti trovi in:',
        'lang_switch' => 'Vai alla versione inglese',
        'index' => '<span lang=en>Home</span>',
        'area_utente' => 'Area Utente',
        'login' => '<span lang=en>Login</span>',
        'signup' => 'Registra Account',
        'logout' => '<span lang=en>Logout</span>',
        'admin' => 'Amministrazione',
        'prenota' => 'Prenota',
        'modifica_prenotazione' => 'Modifica Prenotazione',
        'crea_recensione' => 'Crea Recensione',
        'modifica_recensione' => 'Modifica Recensione',
        'amministrazione_stanza' => 'Amministrazione Stanza',
        // Admin
        'rooms' => 'Stanze',
        // Amministrazione Stanza
        // Area Utente
        'in_as' => 'Attualmente loggati come: ',
        'next_bookings' => 'Prossime Prenotazioni:',
        'past_bookings' => 'Prenotazioni Passate:',
        'write_reviews' => 'Scrivi una recensione:',
        'written_reviews' => 'Recensioni scritte:',
        'no_next_bookings' => 'Non hai prenotazioni future.',
        'no_past_bookings' => 'Non hai prenotazioni passate.',
        'no_available_review' => 'Non hai stanze da recensire',
        'no_written_review' => 'Non hai recensioni scritte.',
        'room' => 'Stanza',
        'edit_booking' => 'Modifica',
        'create_review_for' => 'Crea recensione per Stanza',
        'score' => 'Valutazione',
        'text' => 'Testo',
        'edit_review' => 'Modifica recensione',
        // Crea Recensione
        'create_review_for_num' => 'Crea Recensione per stanza n',
        'write_review' => 'Scrivi la recensione',
        'create_review_button' => 'Crea',
        // Index
        'difficulty' => 'Difficoltà',
        'players' => 'Giocatori',
        'time' => 'Durata',
        'booking_button' => 'Prenota Ora',
        // Login
        'register_prompt' => 'Non hai un <span lang="en">account</span>?',
        'register_link' => 'Registrati adesso',
        'label_username' => '<span lang="en">Username</span>',
        'label_password' => '<span lang="en">Password</span>',
        'login_button' => 'Accedi',
        // Logout
        'logout_success' => 'Logout effettuato con successo',
        'login_link' => 'Clicca qui per effettuare il login',
        // Modifica Prenotazione
        'edit_booking_ID' => 'Modifica prenotazione ID',
        'booking' => 'Prenotazione',
        'by' => 'da',
        'where' => 'alla stanza',
        'edit' => 'Modifica',
        'delete' => 'Elimina',
        'day_select' => 'Selezione del giorno',
        'slot_select' => 'Selezione dello slot',
        // Modifica Recensione
        'edit_the_review' => 'Modifica la recensione',
        // Prenota
        'room_booking' => 'Prenotazione Stanza',
        'book' => 'Prenota',
        // Signup
    ],
    'en' => [
        // base_layout & page names
        'skip' => 'Skip to content',
        'nav_toggle' => 'open/close navigation bar',
        'breadcrumb' => 'You are in:',
        'lang_switch' => 'Go to Italian version',
        'index' => 'Home',
        'area_utente' => 'User Area',
        'login' => 'Login',
        'signup' => 'Sign Up',
        'logout' => 'Logout',
        'admin' => 'Administration',
        'prenota' => 'Book',
        'modifica_prenotazione' => 'Edit Booking',
        'crea_recensione' => 'Create Review',
        'modifica_recensione' => 'Modify Review',
        'amministrazione_stanza' => 'Room Administration',
        // Admin
        'rooms' => 'Rooms',
        // Amministrazione Stanza
        // Area Utente
        'in_as' => 'Currently logged in as: ',
        'next_bookings' => 'Next Bookings:',
        'past_bookings' => 'Past Bookings:',
        'write_reviews' => 'Write a review:',
        'written_reviews' => 'Written Reviews:',
        'no_next_bookings' => "You don't have any next booking.",
        'no_past_bookings' => "You don't have any past booking.",
        'no_available_review' => "You don't have any room to review.",
        'no_written_review' => "You don't have any review.",
        'room' => 'Room',
        'edit_booking' => 'Edit',
        'create_review_for' => 'Create a review for Room',
        'score' => 'Score',
        'text' => 'Text',
        'edit_review' => 'Edit review',
        // Crea Recensione
        'create_review_for_num' => 'Write review for room n',
        'write_review' => 'Write the review',
        'create_review_button' => 'Create',
        // Index
        'difficulty' => 'Difficulty',
        'players' => 'Players',
        'time' => 'Duration',
        'booking_button' => 'Book Now',
        // Login
        'register_prompt' => "Don't have an account?",
        'register_link' => 'Register now',
        'label_username' => 'Username',
        'label_password' => 'Password',
        'login_button' => 'Login',
        // Logout
        'logout_success' => 'Logged out successfully',
        'login_link' => 'Click here to login',
        // Modifica Prenotazione
        'edit_booking_ID' => 'Edit booking ID',
        'booking' => 'Booking',
        'by' => 'by',
        'where' => 'at Room',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'day_select' => 'Select day',
        'slot_select' => 'Select slot',
        // Modifica Recensione
        'edit_the_review' => 'Edit the review',
        // Prenota
        'room_booking' => 'Room Booking',
        'book' => 'Book',
        // Signup
    ]
];
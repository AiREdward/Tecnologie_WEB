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

$page_hierarchy = [
    // '#' indicates that the page has no father
    'index' => 'index',
    'area_utente' => 'index',
    'admin' => 'index',
    'login' => 'area_utente',
    'signup' => 'area_utente',
    'logout' => 'area_utente',
    'book' => 'index',
    'modify_booking' => 'user_area',
    'create_review' => 'user_area',
    'modify_review' => 'user_area',
    'room_administration' => 'admin'
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
    ]
];
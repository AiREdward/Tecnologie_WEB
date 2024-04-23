<?php
// Pages contained in the navbar
$navbar_pages = [
    'index',
    'user_area'
];

$access_keys = [
    'index' => 'h',
    'user_area' => 'u'
];

$page_hierarchy = [
    'index' => 'index',
    'user_area' => 'index',
    'admin' => 'index',
    'login' => 'user_area',
    'signup' => 'user_area',
    'logout' => 'user_area',
    'booking' => 'index',
    'edit_booking' => 'user_area',
    'create_review' => 'user_area',
    'edit_review' => 'user_area',
    'room_administration' => 'admin'
];
<?php

$head_template = '<title><TITLE/></title>
    <meta charset="utf-8">
    <meta name="keywords" content="TODO">
    <meta name="description" content="TODO">
	<meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/print.css" media="print">
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
';

function get_title() : string {
    return 'Titolo';
}

function get_head() {
    global $head_template;

    $title = get_title();
    $output= str_replace("<TITLE/>", $title, $head_template);

    return $output;
}

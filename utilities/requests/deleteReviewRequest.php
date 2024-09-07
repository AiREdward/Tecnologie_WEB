<?php
require_once '../review_util.php';

// File used by editReview.js for deleting a review

$review_id = $_REQUEST['id'];

deleteReview($review_id);

$_SESSION['review_id_editing'] = null;
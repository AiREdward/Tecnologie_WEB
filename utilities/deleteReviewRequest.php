<?php

    require_once "utilitiesReview.php";

    // File usato da deleteReview.js per eliminare una recensione

    $review_id = $_REQUEST["id"];

    deleteReview($review_id);

    $_SESSION["review_id_editing"] = null;

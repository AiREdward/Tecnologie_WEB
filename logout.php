<?php

    require_once "utilities/UserFunctions.php";

    logout();

    header("Location: area_utente.php");

    session_destroy();
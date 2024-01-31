<?php

    // trim() rimuove gli spazi vuoti all'inizio e alla fine della stringa
    // htmlentities() converte i caratteri speciali in entità HTML
    function sanitizeInput($input): string {
        return htmlentities(trim($input));
    }

    function checkInputCorrectness($input, $regex) {
        return preg_match($regex, $input);
    }

?>
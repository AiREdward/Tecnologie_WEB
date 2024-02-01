<?php
function Clean($raw_in){
    return htmlentities(trim($raw_in));
}
function Check($raw_in,$regex){
    return preg_match($regex, $raw_in);
}
?>
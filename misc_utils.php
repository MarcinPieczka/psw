<?php

function redirect($url) {
    header('Location: ' . $url);
}
function session_load() {
    if(!isset($_SESSION)){
        session_start();
    }
}
?>

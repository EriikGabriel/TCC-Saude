<?php

$destroy = filter_input(INPUT_POST, "destroy", FILTER_SANITIZE_SPECIAL_CHARS);

if (session_status() != 2) session_start();

if (session_status() == 2 && $destroy == true) {
    session_destroy();
} else {
    $session = (isset($_SESSION['user'])) ? json_encode($_SESSION['user']) : false;
    echo $session;
}

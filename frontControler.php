<?php

include_once 'sessionUtil.php';
include_once 'config.php';
include_once 'utilControler.php';
include_once 'user/userService.php';

function handle() {
    $pageName = $_GET['page'];
    if ($pageName == 'user') {
        forward("user.php");
    }
}

function handleUser() {
    initUser();
}

function initUser() {
    if (!isset($_SESSION['user']) || $_SESSION['user'] == NULL) {
        $_SESSION['user'] = findAllUser();
    }
}

?>

<?php


define('STORE_PATH', 'userData/');
define('USER_ID', 'kunden_nr_');
require '../vendor/autoload.php';
require 'function.php';

if(!isset($_POST['id'])) {
    header('Location: /');
}


if(isset($_POST['id'])) {
    $error = destroy($_POST['id']);
    if($error) {
        echo $error;
        exit();
    }
    header('Location: /');
}

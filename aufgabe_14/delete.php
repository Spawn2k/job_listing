<?php


define('STORE_PATH', 'userData/');
define('USER_ID', 'kunden_nr_');
require '../vendor/autoload.php';
require 'function.php';

if(!isset($_POST['id'])) {
    header('Location: /');
}


if(isset($_POST['id'])) {
    destroy($_POST['id']);
    header('Location: /');
}

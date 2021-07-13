<?php
require_once 'functions/config.php';

$_SESSION = [];
$params = session_get_cookie_params();
setcookie(session_name(), '', time() - 60*60*24*30 ,$params['path']);
session_destroy();

header('Location:blog.php');
die();

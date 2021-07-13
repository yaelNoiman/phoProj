<?php

if (session_status() === PHP_SESSION_NONE) {
    session_name('my_blog');
    session_start();
}

function printi($data) {
    echo '<pre>' . print_r($data, true) . '</pre>';
}

//Connect to the DB and check the connection.
$link = mysqli_connect('127.0.0.1', 'root', '', 'php_blog');

if (!$link) {
    echo 'Can not connect to server.';
    error_log('Can not connect to server.' . mysqli_connect_error());
    die();
}

//Define for MySQL the character set to expect from PHP.
//Relevant for Hebrew, Arabic and other non-ASCII languages.
mysqli_query($link, 'SET NAMES UTF8');

function get_token() {
    return $_SESSION['token'] = uniqid('token_', true);
}

function check_token() {
    if (empty($_SESSION['token']) ||
            empty($_POST['token']) ||
            $_SESSION['token'] !== $_POST['token']) {
        die('Action failed');
    }
}

function validate_user() {
    if (isset($_SESSION['user_id'])) {
        if (empty($_SESSION['user_ip']) ||
                empty($_SESSION['user_agent']) ||
                $_SESSION['user_ip'] !== $_SERVER['REMOTE_ADDR'] ||
                $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
            unset($_SESSION['user_id']);
            header('location: blog.php');
            die();
        }
        return true;
    }
}

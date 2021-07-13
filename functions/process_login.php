<?php

require_once 'functions/validations.php';
$email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
$pw = trim(filter_input(INPUT_POST, 'pw'));


if (!$email) {
    $messages[] = 'Email is not valid';
}

if (!validate_pw($pw)) {
    $messages[] = 'Password must be at least 4 characters...';
}

if (!empty($messages)) {
    return;
}

$email = mysqli_real_escape_string($link, $email);
$query = " SELECT * "
        . "FROM users "
        . "WHERE user_email='$email';";


if (!$result = mysqli_query($link, $query)) {
    $messages[] = 'An error...';
    return;
}

if (!mysqli_num_rows($result)) {
    $messages[] = 'Wrong data';
    return;
}

$row = mysqli_fetch_assoc($result);

if ($pw_match = password_verify($pw, $row['user_pw'])) {
    $_SESSION['user_name'] = htmlentities($row['user_name'], ENT_HTML5, "utf-8", false);
    $_SESSION['user_id'] = $row['user_id'];
    $_SESSION['user_image'] = $row['user_image'];

    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

    header('Location: blog.php');
    die();
} else {
    $messages[] = 'Wrong data';
}


<?php

require_once 'functions/validations.php';
define('MAX_UPLOAD_SIZE', 1024 * 1024 * 5);

$fname = trim(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING));
$email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
$pw = trim(filter_input(INPUT_POST, 'pw'));

if (!validate_str($fname)) {
    $messages[] = 'Name must be at least 2 characters...';
}

if (!validate_pw($pw)) {
    $messages[] = 'Password must be at least 4 characters...';
}
if (!$email) {
    $messages[] = 'Email is not valid';
} else {
    $email = mysqli_real_escape_string($link, $email);

    $query = "SELECT * "
            . "FROM users "
            . "WHERE user_email= '$email';";

    if (!$result = mysqli_query($link, $query)) {
        $messages[] = 'An error...';
        return;
    }
    
    if (mysqli_num_rows($result)) {
        $messages[] = 'This email alredy exist';
    }
}

if (empty($_FILES['profile_image'])) {
    $messages[] = 'Something went wrong....';
}

if (!empty($messages)) {
    return;
}

if ($_FILES['profile_image']['error'] == UPLOAD_ERR_NO_FILE) {
    $image = '';
} else {
    if ($_FILES['profile_image']['error'] != UPLOAD_ERR_OK) {
        $messages[] = 'Error';
        return;
    }

    if ($_FILES['profile_image']['size'] > MAX_UPLOAD_SIZE) {
        $messages[] = 'Too big';
        return;
    }

    if ($_FILES['profile_image']['size'] == 0) {
        $messages[] = 'Empty';
        return;
    }

    if (strpos($_FILES['profile_image']['type'], 'image/') !== 0) {
        $messages[] = 'Plese ...only images';
        return;
    }

    $image = 'uploads/' . date('d-m-y-h-i-s') . $_FILES['profile_image']['name'];
    $uploaded = move_uploaded_file($_FILES['profile_image']['tmp_name'], $image);

    if (!$uploaded) {
        $messages[] = 'error';
        return;
    }
}

$fname = mysqli_real_escape_string($link, $fname);
$email = mysqli_real_escape_string($link, $email);
$pw = password_hash($pw, PASSWORD_DEFAULT);

$query = "INSERT INTO users (user_name, user_pw, user_email, user_image) "
        . "VALUES ('$fname', '$pw', '$email', '$image');";

if (!$result = mysqli_query($link, $query)) {
    $messages[] = 'An error...';
    return;
}

$success = 'Registration process completed successfully';
   



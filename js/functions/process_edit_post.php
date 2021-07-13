<?php

if (!validate_user() ||
        $post['author_id'] != $_SESSION['user_id'] ||
        !isset($_POST['edit_post'])) {
    header('Location: blog.php');
    die();
}

require_once 'functions/validations.php';
define('MAX_UPLOAD_SIZE', 1024 * 1024 * 5);

$post_title = trim(filter_input(INPUT_POST, 'post_title', FILTER_SANITIZE_STRING));
$post_content = trim(filter_input(INPUT_POST, 'post_content', FILTER_SANITIZE_STRING));

if (!validate_str($post_title)) {
    $messages[] = 'The title is...';
}

if (!validate_str($post_content)) {
    $messages[] = 'The content is...';
}

if (empty($_FILES['post_image'])) {
    $messages[] = 'Something want wrong...';
}

if (!empty($messages)) {
    return;
}


if ($_FILES['post_image']['error'] == UPLOAD_ERR_NO_FILE) {
    $image = $post['image'];
} else {
    if ($_FILES['post_image']['error'] != UPLOAD_ERR_OK) {
        $messages[] = 'Error';
        return;
    }

    if ($_FILES['post_image']['size'] > MAX_UPLOAD_SIZE) {
        $messages[] = 'Too big';
        return;
    }

    if ($_FILES['post_image']['size'] == 0) {
        $messages[] = 'Empty';
        return;
    }

    if (strpos($_FILES['post_image']['type'], 'image/') !== 0) {
        $messages[] = 'Plese ...only images';
        return;
    }

    $image = 'uploads/' . date('d-m-y-h-i-s') . $_FILES['post_image']['name'];
    $uploaded = move_uploaded_file($_FILES['post_image']['tmp_name'], $image);

    if (!$uploaded) {
        $messages[] = 'error';
        return;
    }
}


$post_title = mysqli_real_escape_string($link, $post_title);
$post_content = mysqli_real_escape_string($link, $post_content);

$query =  "UPDATE posts "
        . "SET post_title = '$post_title', post_content =  '$post_content',"
        . " post_image='$image'"
        . "WHERE post_id = $id;";

if (!mysqli_query($link, $query)) {
    $messages = 'Something want wrong...';
    return;
}

if (!empty($uploaded) && !empty($post['image'])) {
    unlink($post['image']);
}
header("location: post.php?post_id=$id");
die();







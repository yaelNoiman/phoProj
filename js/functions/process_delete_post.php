<?php

if (!validate_user() ||
        $post['author_id'] != $_SESSION['user_id'] ||
        !isset($_POST['delete_post'])) {
    header('Location: blog.php');
    die();
}


$query = "DELETE FROM posts "
        . "WHERE post_id = $id "
        . "LIMIT 1;";

if (!mysqli_query($link, $query)) {
    //We could not run the query.
    error_log('Could not query the DB... ');
    die('error..');
}

if (!empty($post['image'])) {
    unlink($post['image']);
}

header("location: blog.php");
die();



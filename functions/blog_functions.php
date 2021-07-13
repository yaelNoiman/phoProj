<?php

function get_post($id) {
    global $link;

    $query = "SELECT p.*, u.user_name, u.user_id "
            . "FROM posts p "
            . "JOIN users u ON p.post_author = u.user_id "
            . "WHERE p.post_id = $id "
            . "LIMIT 1;";

    if (!$result = mysqli_query($link, $query)) {
        die('error');
    }

    if(! $row = mysqli_fetch_assoc($result)){
        die('Post does not exists.');
    }

    $post['title'] = htmlentities($row['post_title'], ENT_HTML5, "utf-8", false);
    $post['content'] = htmlentities($row['post_content'], ENT_HTML5, "utf-8", false);
    $post['image'] = $row['post_image'];
    $post['author_name'] = htmlentities($row['user_name'], ENT_HTML5, "utf-8", false);
    $post['author_id'] =  $row['user_id'];
    $post['created'] = date('d-m-y', strtotime($row['post_created']));
    return $post;
}

function get_posts() {
    global $link;

    $query = "SELECT *, DATE_FORMAT(post_created, '%d-%m-%y') as post_created "
            . "FROM posts p "
            . "JOIN users u ON p.post_author = u.user_id "
            . "ORDER BY p.post_created DESC;";

    if (!$posts = mysqli_query($link, $query)) {
        die('error');
    }

    return $posts;
}

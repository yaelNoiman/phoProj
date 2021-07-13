<?php
$title = "Delete post";
require 'functions/config.php';
require 'functions/blog_functions.php';
require 'templates/header.php';

if (!isset($_GET['post_id'])) {
    header('Location: blog.php');
    die();
}

$id = (int) $_GET['post_id'];
$post = get_posts($id);
$post = mysqli_fetch_assoc($post);

if (!validate_user() || $post['post_author'] != $_SESSION['user_id']) {
    header('Location: blog.php');
    die();
}
?>

<div class="container">
    <h2>Are you sure that you want to delete this post?
        <form method="post">
            <input type="submit" value="DELETE POST" name="delete_post" class="btn btn-danger">
        </form>
    </h2>
    <div>
    </div>
    <h3><?= $post['post_title']; ?></h3>
    <p>By <?= $post['user_name']; ?> /at <?= $post['post_created']; ?></p>
    <?php if (!empty($post['post_image'])) : ?>
        <img src="<?= $post['post_image']; ?>">
    <?php endif; ?>
    <article>
        <?= $post['post_content']; ?>
    </article>

</div>
<?php
require 'templates/footer.php';

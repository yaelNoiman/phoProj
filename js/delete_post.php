<?php
$title = "Delete post";
require 'functions/config.php';
require 'functions/blog_functions.php';


if (!isset($_GET['post_id'])) {
    header('Location: blog.php');
    die();
}

$id = (int) $_GET['post_id'];
$post = get_post($id);

if (!validate_user() || $post['author_id'] != $_SESSION['user_id']) {
    header('Location: blog.php');
    die();
}

if (isset($_POST['delete_post'])) {
    check_token();
    require_once 'functions/process_delete_post.php';
}
require 'templates/header.php';
?>

<div class="container">
    <h1>Delete post</h1>
    <h2>Are you sure that you want to delete this post?</h2>

    <h3><?= $post['title']; ?></h3>
    <p>By <?= $post['author_name']; ?> /at <?= $post['created']; ?></p>
    <?php if (!empty($post['image'])): ?>
    <img class="image" src="<?= $post['image']; ?>">
    <?php endif; ?>
    <article>
        <?= $post['content']; ?>
    </article>

    <div>
        <form method="post">       
            <input type="submit" value="DELETE POST" name="delete_post" class="btn btn-danger">
            <input type="hidden" name="token" value="<?= get_token(); ?>">
        </form>
    </div>
</div>
<?php
require 'templates/footer.php';


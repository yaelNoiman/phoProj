<?php
$title = 'Post';
require_once 'functions/config.php';
require_once 'functions/blog_functions.php';

if (!isset($_GET['post_id'])) {
    header('Location:blog.php');
    die();
}

$id = (int) $_GET['post_id'];
$post = get_post($id);


require_once 'templates/header.php';
?>
<div class="container post">

    <h1><?= $post['title']; ?></h1>
    <p>By <?= $post['author_name']; ?> /at <?= $post['created']; ?></p>
    <?php if (!empty($post['image'])): ?>
        <img src="<?= $post['image']; ?>">
    <?php endif; ?>
    <article>
        <?= $post['content']; ?>
    </article>

</div>
<?php require_once 'templates/footer.php'; ?>


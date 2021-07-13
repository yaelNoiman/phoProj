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


<div class="card" style="width: 18rem; margin: 30px;">
    <?php if (!empty($post['image'])) : ?>
        <img class="card-img-top" src="<?= $post['image']; ?>" ;>
    <?php endif; ?>
    <div class="card-body">
        <h1 class="card-title"><?= $post['title']; ?></h1>
        <p>By <?= $post['author_name']; ?> at <?= $post['created']; ?></p>
        <p class="card-text"> <?= $post['content']; ?></p>
    </div>
</div>




<?php require_once 'templates/footer.php'; ?>
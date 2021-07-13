<?php
$title = 'Edit post';
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

if (isset($_POST['edit_post'])) {
    check_token();
    require 'functions/process_edit_post.php';
}

require 'templates/header.php';
?>
<div class="container">
    <h1>Edit post</h1>
    <div class="row">
        <div class="col-md-4">
            <?php require_once 'templates/notifications.php' ?>
            <form method="post" enctype="multipart/form-data"> 
                <p>
                    <label for="post-title" class="form-label">Title</label>
                    <input id="post-title" type="text" name="post_title" value="<?= $post['title']; ?>" class="form-control" >
                </p>
                <p><label for="post-content" class="form-label">Content</label>
                    <textarea id="post-content" name="post_content" class="form-control"><?= $post['content']; ?></textarea>
                </p>
                <?php if (!empty($post['image'])): ?>
                    <p><img src="<?= $post['image']; ?>" alt="<?= $post['title']; ?>"></p>
                <?php endif; ?>
                <p><label for="post-image"  class="form-label">Update image</label>
                    <input id="post-image" type="file" name="post_image" accept="image/*">
                </p>
                <input type="hidden" name="token" value="<?= get_token(); ?>"> 
                <p><input type="submit" value="Edit" name="edit_post" class="btn btn-primary">
                </p>
            </form>
        </div>
    </div>
</div>

<?php
require 'templates/footer.php';


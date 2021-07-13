<?php
$title = 'Add new post';
require_once 'functions/config.php';

if (!validate_user()) {
    header('Location:blog.php');
    die();
}

if (isset($_POST['add_new_post'])) {
    check_token();
    require_once 'functions/process_add_post.php';
}

require_once 'templates/header.php';
?>
<div class="container">
    <?php require_once 'templates/notifications.php'; ?>
    <div class="row">
        <div class="col-md-4">
            <form method="post" enctype="multipart/form-data"> 
                <p><label for="post-title" class="form-label">Title</label>
                    <input id="post-title" type="text" name="post_title" class="form-control" >
                </p>
                <p><label for="post-content">Content</label>
                    <textarea id="post-content" name="post_content" class="form-control"></textarea>
                </p>
                <p><label for="post-image" class="form-label">Image</label>
                    <input id="post-image" type="file" name="post_image" accept="image/*">
                </p> 
                <input type="hidden" name="token" value="<?= get_token(); ?>">
                <p><input type="submit" value="Add post" name="add_new_post" class="btn btn-dark btn-lg" >
                </p>
            </form>
        </div>
    </div>
</div>
<?php require_once 'templates/footer.php'; ?>


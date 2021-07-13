<?php
$title ="Edit post";
require 'functions/config.php';
require 'functions/blog_functions.php';
require 'templates/header.php';


$id = (int) $_GET['post_id'];
$post = get_posts($id);
$post = mysqli_fetch_assoc($post);
?>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <form method="post" enctype="multipart/form-data" style="border-style: inset; padding:10px;"> 
                <p>
                    <label for="post-title" class="form-label">Title</label>
                    <input id="post-title" type="text" name="post_title" class="form-control" value="<?=$post['post_title'];?>" >
                </p>
                <p><label for="post-content" class="form-label">Content</label>
                    <textarea id="post-content" name="post_content" class="form-control" value="<?=$post['post_content'];?>"></textarea>
                </p>
                <p><label for="post-image"  class="form-label">Update image</label>
                    <input id="post-image" type="file" name="post_image" accept="image/*">
                </p>
                <p><input type="submit" value="Edit" name="edit_post" class="btn btn-primary">
                </p>
            </form>
        </div>
    </div>
</div>

<?php
require 'templates/footer.php';


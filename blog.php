<?php
$title = "Blog";
require_once 'functions/config.php';
require_once 'functions/blog_functions.php';
require_once 'templates/header.php';

$posts = get_posts();
?>

<div class="container">
    <?php if (validate_user()) : ?>
        <a class="btn btn-dark btn-lg" href="add_post.php" role="button">Add new post</a>
    <?php endif; ?>

    <?php if ($posts) : ?>
        <div class="container">
            <?php
            while ($row = mysqli_fetch_assoc($posts)) :
                $title = htmlentities($row['post_title'], ENT_HTML5, "utf-8", false);
                $content = htmlentities($row['post_content'], ENT_HTML5, "utf-8", false);
                $image = $row['post_image'];
                $author_name = htmlentities($row['user_name'], ENT_HTML5, "utf-8", false);
                $excerpt = mb_strlen($content) < 400 ? $content : mb_substr($content, 0, 400) . '...';
            ?>

                <div class="row row-cols-5 row-cols-md-2 g-5 mt-5">
                    <div class="col">
                        <div class="card" style="border-style: inset;">
                            <?php if (!empty($image)) : ?>
                                <img class="card-img-top" src="<?= $image; ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= $title; ?>

                                    <a style="text-decoration:none" href="edit_post.php?post_id=<?= $row['post_id']; ?>">
                                        <img style="width:20px" src="css/img/pencil.png">
                                    </a>
                                    <a style="text-decoration:none" href="delete_post.php?post_id=<?= $row['post_id']; ?>">
                                        <img style="width:20px" src="css/img/rubbish.png">
                                    </a>

                                </h5>
                                <p>By <?= $author_name ?> at <?= $row['post_created']; ?></p>
                                <p class="card-text"><?= $excerpt; ?></p>
                                <?php if (validate_user() && $row['post_author'] == $_SESSION['user_id']) : ?>

                                <?php endif; ?>

                                <a href="post.php?post_id=<?= $row['post_id']; ?>">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>

        </div>
    <?php endif; ?>
</div>

<?php
require 'templates/footer.php';

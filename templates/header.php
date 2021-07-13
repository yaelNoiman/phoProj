<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet" type="text/css">
        <title><?= $title ?? 'My blog'; ?></title>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #eb8b85; font-size:28px;"> 
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" style="background-color: #eb8b85;">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="hp.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about.php">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="blog.php">Blog</a>
                            </li>
                            <?php if (!validate_user()): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="registration.php">Sign up</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php">Login</a>
                                </li>

                            <?php endif; ?>
                        </ul> 
                        <?php if (validate_user()): ?>
                            <p>Hello, <?= ucwords(strtolower($_SESSION['user_name'])); ?>
                                <?php if (!empty($_SESSION['user_image'])): ?>
                                    <img class="profile-image" src="<?= $_SESSION['user_image']; ?>">
                                <?php endif; ?>
                                <a href="logout.php" style="text-decoration: none; color:white">Log out</a>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
            <h1 style="padding: 20px; margin-left: 50px;"><?= $title ?? 'My blog'; ?></h1>
            <hr>
        </header>


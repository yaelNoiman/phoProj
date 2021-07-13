<?php
$title = "Log in";
require_once 'functions/config.php';

if (isset($_POST['login'])) {
    check_token();
    require_once 'functions/process_login.php';
}

require_once 'templates/header.php';
?>
<div class="container">
    <?php require_once 'templates/notifications.php'; ?>
    <div class="row">
        <div class="col-md-4">           
            <form method="post" style="border-style: inset; padding:10px;">
                <p>
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="text" name="email" class="form-control">
                </p> 
                <p>
                    <label for="pw" class="form-label">Password</label>
                    <input  id="pw" type="password" name="pw" class="form-control">
                </p>  
                <input type="hidden" name="token" value="<?= get_token(); ?>">
                <p><input type="submit" name="login" value="Login" class="btn btn-primary"></p>
            </form>
        </div>
    </div>
</div>
<?php require_once 'templates/footer.php'; ?>


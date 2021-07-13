<?php
$title = 'Home Page';
require_once 'functions/config.php';
require_once 'templates/header.php';
?>
   
<div class="container" >
    <div id="carouselExampleControls" class="carousel slide " data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="css/img/1.jpg" class="d-block w-70 " alt="blog_pic">
            </div>
            <div class="carousel-item">
                <img src="css/img/2.jpg" class="d-block w-70" alt="blog_pic">
            </div>
            <div class="carousel-item">
                <img src="css/img/3.jpg" class="d-block w-70" alt="blog_pic">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<?php require_once 'templates/footer.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
        <link
    rel="stylesheet"
    href="https://unpkg.com/swiper@7/swiper-bundle.min.css"
    />
    <?php $this->view('frontend.public.base')?>
</head>
<body>
<?php $this->view('frontend.public.header')?>
<nav aria-label="breadcrumb">
    <a href="./index.php?controller=product"><i class="fas fa-times close-btn mr-2 mt-2"></i></a>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><?= $categoryNameLv1 ?></li>
        <li class="breadcrumb-item"><?= $categoryNameLv2 ?></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $categoryNameLv3 ?></li>
    </ol>
</nav>
<!-- Slider main container -->
<div class="swiper">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
        <div class='swiper-slide'><img src='<?= $thumbnail ?>' alt="Ảnh <?= $product["title"] ?>"></div>
        <?php 
            foreach($details as $item){
            echo "<div class='swiper-slide'><img src='$item' alt='Ảnh ${product["title"]}'></div>"; 
            } 
        ?>
    </div>
<!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div>
<div class="container-fluid">
    <ul class="list-group list-group-flush">
    <li class="list-group-item"><b>Tên sản phẩm: </b> <?= $product["title"] ?></li>
    <li class="list-group-item"><b>Giá:</b> <?=  number_format($product["price"], 0, '', ',');?> VND</li>
    <li class="list-group-item"><b>Giảm giá:</b> <?= $product["discount"] ?>%</li>
    <li class="list-group-item"><b>Mô tả sản phẩm:</b></li>
    <li style="overflow-y: scroll;height:400px" class="list-group-item"><?= $product["description"] ?></li>
    </ul>
</div>
<?php $this->view('frontend.public.footer') ?>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
<script>
        const swiper = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,

    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    autoplay: {
    delay: 5000,
    },

    // And if we need scrollbar
    scrollbar: {
        el: '.swiper-scrollbar',
    },
    });
</script>

</body>
</html>

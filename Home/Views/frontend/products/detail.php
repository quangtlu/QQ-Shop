<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
    <title>Chi tiết sản phẩm</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php $this->view("frontend.public.base") ?>

</head>

<body>
    <?php 
        $this->view("frontend.public.header") 
    ?>
    <!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
                <li><a href="./"><i class="glyphicon fas fa-home"></i></span>Trang chủ</a></li>
                <li class="active"><?= $categoryNameLv1 ?></li>
                <li class="active"><?= $categoryNameLv2 ?></li>
                <li class="active"><?= $categoryNameLv3 ?></li>
            </ol>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <!-- single -->
    <div id="alert"></div>
    <div class="single">
        <div class="container">
            <div class="col-md-4 products-left">
                <div class="categories animated wow slideInUp" data-wow-delay=".5s">
                    <h3>Danh mục</h3>
                    <ul class="cate"></ul>
                </div>
                <div class="men-position animated wow slideInUp" data-wow-delay=".5s">
                    <a href="single.html"><img src="<?= $thumbnail ?>" alt="Ảnh<?= $product["title"] ?>"
                            class="img-responsive" /></a>
                    <div class="men-position-pos">
                        <h5> Giảm giá <span><?= $product["discount"] ?>%</span></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-8 single-right">
                <div class="col-md-5 single-right-left animated wow slideInUp" data-wow-delay=".5s">
                    <img style='width:272px' id='img_01' src='<?= $thumbnail ?>' data-zoom-image='<?= $thumbnail ?>' />
                    <div class="gallery-wrap">
                        <?php foreach($details as $item){
                            echo "
                                <div id='gallery_01'>
                                    <a href='#' data-image='$item' data-zoom-image='$item'>
                                        <img style='width:50px' id='img_01' src='$item' />
                                    </a>
                                </div>
                            ";
                        } ?>
                    </div>
                </div>
                <div class="col-md-7 single-right-left simpleCart_shelfItem animated wow slideInRight"
                    data-wow-delay=".5s">
                    <h3 class="short-text mb-3"><?= $product["title"] ?></h3>
                    <span class="price old-price"><?=$old_price_formated?>₫</span>
                    <span class="price current-price"><?= $current_price_formated ?>₫</span>
                    <span class="discount"><span>Giảm <?= $product["discount"] ?>%</span></span>
                    <div class="rating1 mt-3">
                        <span class="starRating">
                            <input id="rating5" type="radio" name="rating" value="5">
                            <label for="rating5">5</label>
                            <input id="rating4" type="radio" name="rating" value="4">
                            <label for="rating4">4</label>
                            <input id="rating3" type="radio" name="rating" value="3" checked>
                            <label for="rating3">3</label>
                            <input id="rating2" type="radio" name="rating" value="2">
                            <label for="rating2">2</label>
                            <input id="rating1" type="radio" name="rating" value="1">
                            <label for="rating1">1</label>
                        </span>
                    </div>
                    <div  class="occasion-cart mt-5">
                        <a style="cursor:pointer"  data-id="<?= $product["id"] ?>" class="item_add" >Thêm vào giỏ hàng</a>
                    </div>
                    <div class="social">
                        <div class="social-left">
                            <p>Chia sẻ :</p>
                        </div>
                        <div class="social-right">
                            <ul class="social-icons">
                                <li><a href="#" class="facebook"></a></li>
                                <li><a href="#" class="twitter"></a></li>
                                <li><a href="#" class="g"></a></li>
                                <li><a href="#" class="instagram"></a></li>
                            </ul>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
                <div class="bootstrap-tab animated wow slideInUp" data-wow-delay=".5s">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="" id="home-tab" role="tab"
                                    data-toggle="tab" aria-controls="home" aria-expanded="true">Mô tả sản phẩm</a></li>
									<div class="container">
										<?= $product["description"] ?>
									</div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!-- //single -->
    <!-- single-related-products -->
    <div class="single-related-products">
        <div class="container">
            <h3 class="animated wow slideInUp" data-wow-delay=".5s">Sản phẩm liên quan</h3>
            <div class="list-product new-collections-grids"></div>
            <!-- Phân trang -->
            <nav style="margin:10px" aria-label="...">
                <ul class="pagination ml-2">
                    <?php for ($i = 1; $i <= $pageTotal; $i++): ?>
                        <li class="page-item">
                            <a style="cursor: pointer;" class="page-link"><?= $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
    <!-- //single-related-products -->
    <?php $this->view("frontend.public.footer") ?>
    <!-- flixslider -->
    <script async='async' src='https://cdnjs.cloudflare.com/ajax/libs/elevatezoom/3.0.8/jquery.elevatezoom.min.js'></script>

<script>
     window.addEventListener('load', function() {

        // Zoom ảnh sản phẩm
        $("#img_01").elevateZoom({
            constrainType: "height",
            constrainType: "width",
            constrainSize: 272,
            scrollZoom: true,
            zoomWindowFadeIn: 500,

            zoomWindowFadeOut: 500,
            lensShape: "round",
            lensFadeIn: 500,

            lensFadeOut: 500,

            containLensZoom: true,

            gallery: 'gallery_01',

            cursor: 'pointer',

            galleryActiveClass: "active"

            });

            $("#img_01").bind("click", function(e) {

            var ez = $('#img_01').data('elevateZoom');

            $.fancybox(ez.getGalleryList());

            return false;

            });

    })

    $(document).ready(function() {
        
        // Load danh mục trong product detail
        $.ajax({
            url: './index.php?controller=category&action=loadCategoryList',
            dataType: 'html',
            success: function(data) {
                $('.cate').html(data);
            }
        });
        var id_product = <?= $_GET["id"] ?>
        // Load sản phẩm liên quan
        $.ajax({
            url		: './index.php?controller=product&action=productRelated',
            type: 'POST',
            data: {id_product:id_product},
            dataType: 'html',
            success : function(data){
                $('.list-product').html(data);
            }
        });
        // Thêm sản phẩm đang xem chi tiết vào giỏ hàng
        $('a.item_add').on('click',function(){
            var id = $('a.item_add').attr("data-id")
            $.ajax({
                url		: './index.php?controller=order&action=NumProduct&action=NumProduct',
                data	: {id:id},
                type	: 'POST',
                success : function(data){
                    $('#cart').html(data);

                    var alert_danger = `<div class='alert alert-success' id='success-alert'>
                                            <strong>Sản phẩm đã được thêm vào giỏ hàng</strong>
                                        </div>`;
                    $('#alert').html(alert_danger)
                        $('#success-alert').fadeTo(2000, 500).slideUp(500, function(){
                        $('#success-alert').slideUp(500);
                            });
                            $(document).ready(function() {
                        $('#myWish').click(function showAlert() {
                            $('#success-alert').fadeTo(2000, 500).slideUp(500, function() {
                            $('#success-alert').slideUp(500);
                            });
                        });
                    });
                    
                }
            });
        });
        // Dữ liệu khi click trang sản phẩm liên quan
        $('a.page-link').on('click',function(){
            var _p = $(this).text();
            $.ajax({
                url		: './index.php?controller=product&action=productRelated',
                data	: {page:_p,id_product:id_product},
                type	: 'POST',
                dataType: 'html',
                success : function(data){
                    $('.list-product').html(data);
                    
                }
            });
        });
        // Active số trang khi click
        $( "li.page-item" ).first().addClass('active')

        $(".page-item").click(function () {
            if ($(this).hasClass("active")) {
                $(".page-item").removeClass("active");
            }
            else {
                $(".page-item").removeClass("active");
                $(this).addClass("active");
            }
        });

        
    });
</script>
</body>

</html>
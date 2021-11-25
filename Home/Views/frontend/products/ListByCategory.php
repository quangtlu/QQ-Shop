<?php session_start();?>
<!DOCTYPE html>
<html>

<head>
    <title>Sản phẩm</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php $this->view("frontend.public.base") ?>

</head>

<body>
    <?php $this->view("frontend.public.header") ?>
    <!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
                <li><a href="./index.php"><i class="glyphicon fas fa-home"></i></span>Trang chủ</a></li>
                <li class="active"><?= $categoryNameLv1 ?></li>
                <li class="active"><?= $categoryNameLv2 ?></li>
                <li class="active"><?= $categoryNameLv3 ?></li>
            </ol>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <div class="new-collections">
        <div class="container">
            <div class="col-md-12 products-right">
                <!-- List product -->
                <h3 class='title-list-product animated wow zoomIn' data-wow-delay='.5s'>Danh sách sản phẩm</h3>
                <i style="font-size: 20px;padding-right:5px;color:#d8703f" class="fas fa-sort"></i><select id="sort" style="width:fit-content" class="frm-field required sect">
                    <option selected value="default">Mặc định</option>
			        <option value="new">Sản phẩm mới nhất</option> 
                    <option value="asc">Giá tiền từ thấp đến cao</option>
                    <option value="desc">Giá tiền từ cao đến thấp</option>
                </select>
                <div class="list-product new-collections-grids"></div>
                <!-- Phân trang -->

                <!-- Phân trang -->
                <nav class="numbering animated wow slideInRight" data-wow-delay=".5s" style="margin:10px"
                    aria-label="...">
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= $pageTotal; $i++): ?>
                        <li class="page-item">
                            <a style="cursor: pointer;" class="page-link"><?= $i; ?></a>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <!-- //single-related-products -->
    <?php $this->view("frontend.public.footer") ?>
    <script>
    $(document).ready(function() {
        var id_cate = <?= $_GET["id"] ?>
        // Load sản phẩm theo danh mục
        $.ajax({
            url: './index.php?controller=product&action=productBycategory',
            type: 'POST',
            data: {
                id_cate: id_cate
            },
            dataType: 'html',
            success: function(data) {
                $('.list-product').html(data);
                // Sắp xếp sản phẩm
                $('#sort').on('change', function() {
                    var sortBy = $(this).find(":selected").val();
                    $.ajax({
                        url: './index.php?controller=product&action=productBycategory',
                        data: {
                            sortBy: sortBy,
                            id_cate: id_cate

                        },
                        type: 'POST',
                        dataType: 'html',
                        success: function(data) {
                            $('.list-product').html(data);
                        }
                    });
                });
            }
        });
        // Dữ liệu khi click trang 
        $('a.page-link').on('click', function() {
            var _p = $(this).text();
            $.ajax({
                url: './index.php?controller=product&action=productBycategory',
                data: {
                    page: _p,
                    id_cate: id_cate
                },
                type: 'POST',
                dataType: 'html',
                success: function(data) {
                    $('.list-product').html(data);
                    // Sắp xếp sản phẩm
                    $('#sort').on('change', function() {
                        var sortBy = $(this).find(":selected").val();
                        $.ajax({
                            url: './index.php?controller=product&action=productBycategory',
                            data: {
                                sortBy: sortBy,
                                id_cate: id_cate

                            },
                            type: 'POST',
                            dataType: 'html',
                            success: function(data) {
                                $('.list-product').html(data);
                            }
                        });
			});

                }
            });
        });
        // Active số trang khi click
        $("li.page-item").first().addClass('active')

        $(".page-item").click(function() {
            if ($(this).hasClass("active")) {
                $(".page-item").removeClass("active");
            } else {
                $(".page-item").removeClass("active");
                $(this).addClass("active");
            }
        });


    });
    </script>
</body>

</html>
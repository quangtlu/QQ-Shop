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
	<div class="products">
		<div class="container">
			<div class="col-md-12 products-right">
				<div class="products-right-grid">
					<div class="products-right-grids animated wow slideInRight" data-wow-delay=".5s">
						<div class="sorting">
							<select id="country" onchange="change_country(this.value)" class="frm-field required sect">
								<option value="null">Default sorting</option>
								<option value="null">Sort by popularity</option> 
								<option value="null">Sort by average rating</option>					
								<option value="null">Sort by price</option>								
							</select>
						</div>
						<div class="sorting-left">
							<select id="country1" onchange="change_country(this.value)" class="frm-field required sect">
								<option value="null">Item on page 9</option>
								<option value="null">Item on page 18</option> 
								<option value="null">Item on page 32</option>					
								<option value="null">All</option>								
							</select>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
				<!-- List product -->
				<div class="list-product products-right-grids-bottom"></div>
				<!-- Phân trang -->

				<!-- Phân trang -->
				<nav class="numbering animated wow slideInRight" data-wow-delay=".5s" style="margin:10px" aria-label="...">
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
            url		: './index.php?controller=product&action=productBycategory',
            type: 'POST',
            data: {id_cate:id_cate},
            dataType: 'html',
            success : function(data){
                $('.list-product').html(data);
            }
        });
        // Dữ liệu khi click trang sản phẩm liên quan
        $('a.page-link').on('click',function(){
            var _p = $(this).text();
            $.ajax({
                url		: './index.php?controller=product&action=productBycategory',
                data	: {page:_p,id_cate:id_cate},
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
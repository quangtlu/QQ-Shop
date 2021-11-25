<?php session_start() ;?>
<!DOCTYPE html>
<html>
<head>
	<title>QQ Shop</title>
	<!-- for-mobile-apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<?php $this->view("frontend.public.base") ?>
</head>

<body>
<?php $this->view("frontend.public.header") ?>

<div class="hide-when-search">
	<!-- banner -->
	<div class="banner">
		<div class="container">
			<div class="banner-info animated wow zoomIn" data-wow-delay=".5s">
				<h3>Mua sắm online miễn phí</h3>
				<h4>Giảm giá<span>50% <i>Off/-</i></span></h4>
				<div class="wmuSlider example1">
					<div class="wmuSliderWrapper">
						<article style="position: absolute; width: 100%; opacity: 0;">
							<div class="banner-wrap">
								<div class="banner-info1">
									<p>Thương hiệu thời trang uy tín</p>
								</div>
							</div>
						</article>
						<article style="position: absolute; width: 100%; opacity: 0;">
							<div class="banner-wrap">
								<div class="banner-info1">
									<p>Đồ nội thất chất lượng cao</p>
								</div>
							</div>
						</article>
						<article style="position: absolute; width: 100%; opacity: 0;">
							<div class="banner-wrap">
								<div class="banner-info1">
									<p>Luôn cập nhật sản phẩm công nghệ mới nhất</p>
								</div>
							</div>
						</article>
					</div>
				</div>
				<script src="./Home/Views/frontend/public/web/js/jquery.wmuSlider.js"></script>
				<script>
					$('.example1').wmuSlider();
				</script>
			</div>
		</div>
		<!-- //banner -->
	</div>
	<!-- banner-bottom -->
	<div class="banner-bottom">
		<div class="container">
			<div class="banner-bottom-grids">
				<div class="banner-bottom-grid-left animated wow slideInLeft" data-wow-delay=".5s">
					<div class="grid">
						<figure class="effect-julia">
							<img src="./Home/Views/frontend/public/web/images/4.jpg" alt=" " class="img-responsive" />
							<figcaption>
								<h3>QQ <span>Shop</span><i>Siêu thị gia đình</i></h3>
								<div>
									<p>Sản phẩm giả rẻ, chất lượng</p>
									<p>Tốc độ giao hàng siêu nhanh</p>
									<p>Chăm sóc khách hàng chu đáo</p>
								</div>
							</figcaption>
						</figure>
					</div>
				</div>
				<div class="banner-bottom-grid-left1 animated wow slideInUp" data-wow-delay=".5s">
					<div class="banner-bottom-grid-left-grid left1-grid grid-left-grid1">
						<div class="banner-bottom-grid-left-grid1">
							<img src="https://cf.shopee.vn/file/3bfa81de5b276b1d6c9b0fd124657b7f" alt=" " class="img-responsive" />
						</div>
						<div class="banner-bottom-grid-left1-pos">
							<p>Thiết bị điện tử</p>
						</div>
					</div>
					<div class="banner-bottom-grid-left-grid left1-grid grid-left-grid1">
						<div class="banner-bottom-grid-left-grid1">
							<img src="./Home/Views/frontend/public/web/images/5.jpg" alt=" " class="img-responsive" />
						</div>
						<div class="banner-bottom-grid-left1-position">
							<div class="banner-bottom-grid-left1-pos1">
								<p>Nội thất</p>
							</div>
						</div>
					</div>
				</div>
				<div class="banner-bottom-grid-right animated wow slideInRight" data-wow-delay=".5s">
					<div class="banner-bottom-grid-left-grid grid-left-grid1">
						<div class="banner-bottom-grid-left-grid1">
							<img src="./Home/Views/frontend/public/web/images/3.jpg" alt=" " class="img-responsive" />
						</div>
						<div class="grid-left-grid1-pos">
							<p>Thời trang<span>thịnh hành 2021</span></p>
						</div>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //banner-bottom -->

</div>
<!-- Product -->
<div class="new-collections">
	<div class='container'>
		<!-- Sản phẩm -->
		<h3 class='title-list-product animated wow zoomIn' data-wow-delay='.5s'>Danh sách sản phẩm</h3>
		<i style="font-size: 20px;padding-right:5px;color:#d8703f" class="fas fa-sort"></i></span><select id="sort" style="width:fit-content" class="frm-field required sect">
			<option selected value="default">Mặc định</option>
			<option value="new">Sản phẩm mới nhất</option> 
			<option value="asc">Giá tiền từ thấp đến cao</option> 
			<option value="desc">Giá tiền từ cao đến thấp</option> 							
		</select>
		<div class='list-product new-collections-grids'></div>
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
<?php $this->view("frontend.public.footer") ?>
<script>
$(document).ready(function(){
	

	// Load sản phẩm
	// Dữ liệu khi khởi tạo trang, mặc định trang 1
	$.ajax({
		url		: './index.php?controller=home&action=loadcontent',
		dataType: 'html',
		success : function(data){
			$('.list-product').html(data);
			// Sắp xếp sản phẩm
			$('#sort').on('change', function() {
				var sortBy = $(this).find(":selected").val();
				$.ajax({
					url: './index.php?controller=home&action=loadcontent',
					data: {
						sortBy: sortBy
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
	$('a.page-link').on('click',function(){
		var _p = $(this).text();
		$.ajax({
			url		: './index.php?controller=home&action=LoadContent',
			data	: {page:_p},
			type	: 'POST',
			dataType: 'html',
			success : function(data){
				$('.list-product').html(data);
				// Sắp xếp sản phẩm
				$('#sort').on('change', function() {
					var sortBy = $(this).find(":selected").val();
					$.ajax({
						url: './index.php?controller=home&action=loadcontent',
						data: {
							sortBy: sortBy
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
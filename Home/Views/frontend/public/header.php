	<!-- header -->
	<div class="header">
	    <div class="container">
	        <div class="header-grid">
	            <div class="header-grid-left animated wow slideInLeft" data-wow-delay=".5s">
	                <ul>
	                    <?php 
							if(isset($_SESSION["phone"])){
								echo "
									<li>
										<i class='glyphicon fas fa-user' aria-hidden='true'></i>
										<span data-id='".$_SESSION["phone"]."' class='user-info'></span>
									</li>
									<li>
										<i class='glyphicon fas fa-sign-in-alt' aria-hidden='true'></i>
										<a href='./index.php?controller=home&action=logout'>Đăng xuất</a>
									</li>
									";
							}
							else{
								echo '
									<li>
										<i class="glyphicon fas fa-sign-in-alt" aria-hidden="true"></i>
										<a href="./index.php?controller=home&action=dangky">Đăng ký</a>
									</li>
									<li>
										<i class="glyphicon fas fa-sign-in-alt" aria-hidden="true"></i>
										<a href="./index.php?controller=home&action=dangnhap">Đăng nhập</a>
									</li>
								';
							}
						
						?>
	                </ul>
	            </div>
	            <div class="header-grid-right animated wow slideInRight" data-wow-delay=".5s">
	                <ul class="social-icons">
	                    <li><a href="#" class="facebook"></a></li>
	                    <li><a href="#" class="twitter"></a></li>
	                    <li><a href="#" class="g"></a></li>
	                    <li><a href="#" class="instagram"></a></li>
	                </ul>
	            </div>
	            <div class="clearfix"> </div>
	        </div>
	        <div class="logo-nav">
	            <div class="logo-nav-left animated wow zoomIn" data-wow-delay=".5s">
	                <h1><a href="./">QQ Shop</a></h1>
	            </div>
	            <div class="logo-nav-left1">
	                <nav class="navbar navbar-default">
	                    <!-- Brand and toggle get grouped for better mobile display -->
	                    <div class="navbar-header nav_2">
	                        <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse"
	                            data-target="#bs-megadropdown-tabs">
	                            <span class="sr-only">Toggle navigation</span>
	                            <span class="icon-bar"></span>
	                            <span class="icon-bar"></span>
	                            <span class="icon-bar"></span>
	                        </button>
	                    </div>
	                    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
	                        <ul class="nav navbar__nav">
	                            <li class="active"><a href="./" class="act">Trang chủ</a></li>
	                        </ul>
	                    </div>
	                </nav>
	            </div>
	            <div class="logo-nav-right">
	                <div class="search-box">
	                    <div id="sb-search" class="sb-search">
	                        <form>
	                            <input class="sb-search-input" placeholder="Enter your search term..." type="search"
	                                id="search">
	                            <input class="sb-search-submit" type="submit" value="">
	                            <span class="sb-icon-search"> </span>
	                        </form>
	                    </div>
	                </div>
	                <!-- search-scripts -->
	                <script src="./Home/Views/frontend/public/web/js/classie.js"></script>
	                <script src="./Home/Views/frontend/public/web/js/uisearch.js"></script>
	                <script>
	                new UISearch(document.getElementById('sb-search'));
	                </script>
	                <!-- //search-scripts -->
	            </div>
	            <div class="header-right">
	                <div class="cart box_1">
	                    <a href="./index.php?controller=order">
	                        <h3>
	                            <i class="cart-icon fas fa-shopping-cart">
									<span class="cart-number" id="cart"></span>
								</i>
	                        </h3>
	                    </a>
	                    <div class="clearfix"> </div>
	                </div>
	            </div>
	            <div class="clearfix"> </div>
	        </div>
	    </div>
	</div>
	<!-- //header -->
	<script>
$(document).ready(function() {
    // Load danh mục cấp trên header
    $.ajax({
        url: './index.php?controller=category',
        dataType: 'html',
        success: function(data) {
            $('.navbar__nav').append(data);
        }
    });
    // Load tên người đăng nhập
    var phone = $('.user-info').attr("data-id")
    $.ajax({
        url: './index.php?controller=user&action=info',
        dataType: 'html',
        data: {
            phone: phone
        },
        type: "POST",
        success: function(data) {
            $('.user-info').html(data);
        }
    });
	// Load số sản phẩm trong cart
	$.ajax({
		url		: './index.php?controller=order&action=NumProduct',
		dataType: 'html',
		success : function(data){
			$('#cart').html(data);
		}
	});
});
	</script>
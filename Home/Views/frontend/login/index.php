<!DOCTYPE html>
<html>

<head>
	<title>Đăng nhập</title>
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
				<li><a href="./index.php?controller=home"><span class="glyphicon fas fa-home" aria-hidden="true"></span>Trang chủ</a></li>
				<li class="active">Đăng nhập</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- login -->
<div class="login">
		<div class="container">
			<?php 
				if(!empty($alert)){
					echo "<div class='alert alert-danger' id='success-alert'>
					<strong>$alert</strong>
				</div>";
				} 
				if(!empty($success)){
					echo "<div class='alert alert-success' id='success-alert'>
					<strong>$success</strong>
				</div>";
				}
			?>
			<h3 class="animated wow zoomIn" data-wow-delay=".5s">Đăng nhập</h3>
			<div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
				<form method="POST" action="./index.php?controller=home&action=login">
					<input type="text" name="phone" placeholder="Số điện thoại" required=" " >
					<input type="password" name="password" placeholder="Mật khẩu" required=" " >
					<div class="forgot">
						<a href="#">Quên mật khẩu?</a>
					</div>
					<input type="submit" value="Đăng nhập">
				</form>
			</div>
			<p class="animated wow slideInUp" data-wow-delay=".5s">Nếu bạn chưa có tài khoản</p>
			<p class="animated wow slideInUp" data-wow-delay=".5s"><a href="./index.php?controller=home&action=dangky">Đăng ký</a></p>
		</div>
	</div>
<!-- //login -->
<?php $this->view("frontend.public.footer") ?>
</body>

</html>
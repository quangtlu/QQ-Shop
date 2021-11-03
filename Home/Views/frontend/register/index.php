<!DOCTYPE html>
<html>

<head>
	<title>Đăng ký tài khoản</title>
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
				<li class="active">Đăng ký</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- register -->
	<div class="register">
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
			<h3 class="animated wow zoomIn" style="<?php if(!empty($success)) echo "display:none" ?>" data-wow-delay=".5s">Đăng ký tài khoản</h3>
			<div class="login-form-grids" style="<?php if(!empty($success)) echo "display:none" ?>">
				<form method="POST" action="./index.php?controller=home&action=register" class="animated wow slideInUp" data-wow-delay=".5s">
					<input type="text" name="fullname" placeholder="Họ và tên" required="Nhập họ và tên" >
					<input type="text" style="margin:10px 0" name="phone" placeholder="Số điện thoại" required=" " >
					<input type="email" name="email" placeholder="Email" required=" " >
					<input style="margin:10px 0" type="text" name="address" placeholder="Địa chỉ" required=" " >
					<input type="password" name="password" placeholder="Password" required=" " >
					<input type="password" name="passwordConfirm" placeholder="Password Confirmation" required=" " >
					<input type="submit" value="Đăng ký">
				</form>
			</div>
			<?php 
				if(!empty($success)){
					echo '
						<div class="register-home animated wow slideInUp" data-wow-delay=".5s">
							<a href="./index.php?controller=home&action=dangnhap">Đăng nhập</a>
						</div>
					';
				}
			?>
		</div>
	</div>
<!-- //register -->
<?php $this->view("frontend.public.footer") ?>
</body>

</html>
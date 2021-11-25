<!DOCTYPE html>
<html>

<head>
	<title>Phản hồi</title>
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
				<li class="active">Phản hồi</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- mail -->
			<?php 
				if(!empty($alert)){
					echo "<div class='alert alert-success' id='success-alert'>
					<strong>$alert</strong>
				</div>";
				}
			?>
	<div class="mail animated wow zoomIn" data-wow-delay=".5s">
		<div class="container">
			<h3>Phản hồi</h3>
			<div class="mail-grids">
				<div class="col-md-8 mail-grid-left animated wow slideInLeft" data-wow-delay=".5s">
					<form method="POST" action="./index.php?controller=mail&action=send">
						<input type="text" name="fullname" placeholder="Họ và tên"  required>
						<input type="email" name="email" placeholder="Email" required>
						<input style="margin-bottom:14px" type="text" name="phone" placeholder="Số điện thoại" required>
						<input type="text" name="subject_name" placeholder="Chủ đề"  required>
						<textarea type="text" name="note" placeholder="Nội dung..." required></textarea>
						<input type="submit" value="Gửi" >
					</form>
				</div>
				<div class="col-md-4 mail-grid-right animated wow slideInRight" data-wow-delay=".5s">
					<div class="mail-grid-right1">
						<img src="https://scontent.fhan5-10.fna.fbcdn.net/v/t1.6435-9/122892330_1329552040720205_5933102292458959141_n.jpg?_nc_cat=101&ccb=1-5&_nc_sid=09cbfe&_nc_ohc=Vz7PDgOIMpYAX9yWWpD&_nc_ht=scontent.fhan5-10.fna&oh=e6fcda98978bc40ede785be5cf9b2707&oe=61C14D79" alt=" " class="img-responsive" />
						<h4>Dương Văn Quang<span>Giám đốc điều hành</span></h4>
						<ul class="phone-mail">
							<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>Số điện thoại: +1234 567 893</li>
							<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>Email: <a href="mailto:info@example.com">qqshop@example.com</a></li>
						</ul>
						<ul class="social-icons">
							<li><a href="#" class="facebook"></a></li>
							<li><a href="#" class="twitter"></a></li>
							<li><a href="#" class="g"></a></li>
							<li><a href="#" class="instagram"></a></li>
						</ul>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<iframe class="animated wow slideInLeft" data-wow-delay=".5s" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3098.7638135888296!2d-77.47669308468912!3d39.04350424592369!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89b63eb3bc8da92b%3A0x78c8e09ab1cabc90!2sShopping+Plaza%2C+Ashburn%2C+VA+20147%2C+USA!5e0!3m2!1sen!2sin!4v1457602090579" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</div>
<!-- //mail -->
<?php $this->view("frontend.public.footer") ?>
</body>

</html>
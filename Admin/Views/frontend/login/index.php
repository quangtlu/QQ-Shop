<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="./template/img/svg/Logo.svg" type="image/x-icon">
    <!-- Custom styles -->
    <?php $this->view('frontend.public.base')?>

</head>

<body>
    
    <main class="page-center">
        <?php 
            if($alert != ''){
            echo 
            "<div class='alert alert-danger' id='success-alert' style='top:100px'>
            <strong>$alert !</strong>
            </div>";
            }
        ?>
        <article class="sign-up">
            <h1 class="sign-up__title">Trang quản trị hệ thống</h1>
            <p class="sign-up__subtitle">Vui lòng đăng nhập</p>
            <form method="POST" class="sign-up-form form" action="./index.php?controller=site&action=login">
                <label class="form-label-wrapper">
                    <p class="form-label">Tài khoản</p>
                    <input class="form-input" type="tel" name="phone" placeholder="Nhập số điện thoại" required>
                </label>
                <label class="form-label-wrapper">
                    <p class="form-label">Mật khẩu</p>
                    <input class="form-input" type="password" name="password" placeholder="Nhập mật khẩu" required>
                </label>
                <a class="link-info forget-link" href="##">Quên mật khẩu</a>
                <label class="form-checkbox-wrapper">
                    <input class="form-checkbox" type="checkbox">
                    <span class="form-checkbox-label">Lưu mật khẩu</span>
                </label>
                <button type="submit" class="form-btn primary-default-btn transparent-btn">Đăng nhập</button>
            </form>
        </article>
    </main>
    <?php $this->view('frontend.public.js.boostrapJS') ?>
</body>

</html>
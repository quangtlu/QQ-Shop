<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin người dùng</title>
    <?php $this->view('frontend.public.base')?>

</head>
<body>
<?php $this->view('frontend.public.header')?>
<a href="./index.php?controller=user">
    <i class="fas fa-times close-btn"></i>
</a>
<?php 
  if($alert != ''){
      echo 
      "<div class='alert alert-danger' id='success-alert' style='top:100px'>
      <strong>$alert !</strong>
      </div>";
  }
?>
<div style="min-height:550px" class="container mt-2 animate__animated animate__fadeIn">
  <form method="POST" action="./index.php?controller=user&action=update&id=<?php echo $_GET["id"]?>" class="needs-validation mt-5" novalidate>
    <div class="form-row">
        <div class="col-md-6 mb-6">
          <label for="fullname">Họ tên</label>
          <input type="text" class="form-control" id="fullname" value="<?php echo $users["fullname"] ?>" name="fullname" placeholder="Họ tên" value="" required>
          <div class="invalid-feedback">
              Nhập tên Họ tên
          </div>
        </div>
        <div class="col-md-6 mb-6">
          <label for="">Địa chỉ</label>
          <input type="text" class="form-control" id="" value="<?php echo $users["address"] ?>" name="address" placeholder="Địa chỉ" value="" required>
          <div class="invalid-feedback">
              Nhập Địa chỉ
          </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-6 mb-6">
          <label for="">Số điện thoại</label>
          <input type="tel" class="form-control" id="" value="<?php echo $users["phone"] ?>" name="phone" placeholder="Số điện thoại" value="" required>
          <div class="invalid-feedback">
              Nhập tên số điện thoại
          </div>
        </div>
        <div class="col-md-6 mb-6">
          <label for="">Email</label>
          <input type="email" class="form-control" id="" value="<?php echo $users["email"] ?>" name="email" placeholder="Email" value="" required>
          <div class="invalid-feedback">
              Nhập địa chỉ email
          </div>
        </div>
    </div>
    <div class="form-row">
      <div class="col-md-6 mb-6">
        <label for="">Mật khẩu</label>
        <input type="password" class="form-control" id="" value="<?php echo $users["password"] ?>" name="password" placeholder="Mật khẩu" value="" required>
        <div class="invalid-feedback">
            Nhập Mật khẩu
        </div>
      </div>
      <div class="col-md-6 mb-6">
        <label for="roleName">Nhóm quyền</label>
        <select class="form-control" name="roleName" id="roleName">
            <?php foreach($roles as $item){
              echo "<option value='${item["name"]}'>${item["name"]}</option>";
            } ?>             
        </select>
      </div>
    </div>
    <button id="submitBtn" class="btn btn-primary mt-3" type="submit">Cập nhật</button>  
  </form>
</div>
<?php $this->view('frontend.public.footer')?>
<?php $this->view('frontend.public.js.boostrapJS') ?>

</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh mục cấp 1</title>
    <?php $this->view('frontend.public.base')?>
</head>

<body>
    <?php $this->view('frontend.public.header')?>
    <a  href="./index.php?controller=categorylv1">
        <i style="padding: 20px;" class="fas fa-times close-btn"></i>
    </a>
    <div class="container mt-5 animate__animated animate__fadeIn">
        <?php 
  if($alert != ''){
      echo 
      "<div class='alert alert-danger' id='success-alert' style='top:100px'>
      <strong>$alert !</strong>
      </div>";
  }
?>
        <h2 style="color:blue">Thông tin danh mục sản phẩm</h2>
        <form method="POST" action="./index.php?controller=categorylv1&action=update&id=<?php echo $category["id"] ?>"
            class="needs-validation mt-5" novalidate>
            <div class="form-row">
                <div class="col-md-6 mb-6">
                    <label for="name">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" value="<?php echo $category["name"] ?>"
                        name="name" placeholder="Tên danh mục" value="" required>
                    <div class="invalid-feedback">
                        Nhập tên danh mục
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-6">
                    <label for="description">Mô tả</label>
                    <div class="col-md-12">
                        <textarea style="resize: none; padding:10px" id="description" name="description" id="editor1"
                            rows="10" cols="55"><?php echo $category["description"] ?></textarea>
                    </div>
                </div>
            </div>
            <button id="submitBtn" class="mt-4 btn btn-primary" type="submit">Cập nhật</button>
        </form>

    </div>
    <?php $this->view('frontend.public.footer') ?>
    <?php $this->view('frontend.public.js.boostrapJS') ?>

</body>

</html>
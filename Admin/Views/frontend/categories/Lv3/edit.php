<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh mục cấp 3</title>
    <?php $this->view('frontend.public.base')?>
</head>

<body>
    <?php $this->view('frontend.public.header')?>
    <a href="./index.php?controller=categorylv3">
        <i style="padding: 20px;" class="close-edit-btn fas fa-times"></i>
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
        <h2 style="color:blue">Thông tin danh mục cấp 3</h2>
        <form method="POST" action="./index.php?controller=categorylv3&action=update&id=<?php echo $category["id"] ?>" class="needs-validation mt-5" novalidate>
            <div class="form-row">
                <div class="col-md-4 mb-4">
                    <label for="categoryNameLv1">Danh mục cấp 1</label>
                    <select class="form-control" required name="categoryNameLv1" id="categoryNameLv1">
                        <option selected value="<?php echo $categoryNameLv1 ?>"><?php echo $categoryNameLv1 ?></option>
                        <?php foreach($categoriesLv1Lite as $item){
                            echo "<option value='${item["name"]}'>${item["name"]}</option>";
                        } ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="categoryNameLv2">Danh mục cấp 2</label>
                    <select class="form-control" required name="categoryNameLv2" id="categoryNameLv2">
                        <option selected value="<?php echo $categoryNameLv2 ?>"><?php echo $categoryNameLv2 ?></option>
                        <?php foreach($categoriesLv2Lite as $item){
                            echo "<option value='${item["name"]}'>${item["name"]}</option>";
                        } ?>
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label for="name">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" value="<?php echo $category["name"] ?>" name="name" placeholder="Tên danh mục" value=""
                        required>
                    <div class="invalid-feedback">
                        Nhập tên danh mục
                    </div>
                </div>
               
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-6">
                    <label for="description">Mô tả</label>
                    <div class="col-md-12">
                        <textarea style="resize: none; padding:10px" id="description"  name="description" id="editor1" rows="10" cols="55"><?php echo $category["description"] ?></textarea>   
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
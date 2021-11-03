<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục sản phẩm</title>
    <?php $this->view('frontend.public.base')?>
</head>
<body>
<?php $this->view('frontend.public.header')?>
<?php 
    if($alert != ''){
        echo "<div class='alert alert-danger' id='success-alert' style='top:100px'><strong>$alert !</strong></div>";
    }
?>
<!-- Modal add  start -->
<div class="main-product-layout">
    <a href="./index.php?controller=product"><i class="fas fa-times close-btn"></i></a>
    <form method="POST" enctype="multipart/form-data" action="./index.php?controller=product&action=update&id=<?= $product["id"] ?>" class="needs-validation" novalidate>
        <div class="form-row">
            <div class="col-md-8 mb-8">
                <label class="form-label" for="title">Tên sản phẩm</label>
                <input type="text" class="form-control" id="title" value="<?= $product["title"] ?>" name="title" placeholder="Tên sản phẩm" value=""
                    required>
                <div class="invalid-feedback">
                    Nhập tên sản phẩm
                </div>
            </div>
            <div class="col-md-2 mb-2">
                <label class="form-label" for="price">Giá</label>
                <input type="number" class="form-control" id="price" value="<?= $product["price"] ?>" name="price" placeholder="Giá" value=""
                    required>
                <div class="invalid-feedback">
                    Nhập giá sản phẩm
                </div>
            </div>
            <div class="col-md-2 mb-2">
                <label class="form-label" for="discount">Giảm giá (%) </label>
                <input type="number" class="form-control" id="discount" value="<?= $product["discount"] ?>" name="discount" placeholder="Giảm giá" value=""
                    required>
                <div class="invalid-feedback">
                    Nhập giảm giá
                </div>
            </div>
        </div>                
        <div class="form-row">
            <div class="col-md-8 mb-8">
                <textarea style="resize: none; padding:10px" name="description" id="description" 
                value="<?= $product["description"]?>" ><?= $product["description"]?></textarea>   
                <button id="submitBtn" class="mt-2 btn btn-primary" type="submit">Cập nhật</button>
            </div>
            <div class="col-md-4 mb-4">
                <div class="col-md-12 mb-12">
                    <label class="form-label" for="categoryNameLv1">Danh mục cấp 1</label>
                    <select class="form-control" required name="categoryNameLv1" id="categoryNameLv1">
                        <option></option>
                        <?php foreach($categoriesLv1 as $item){
                            echo "<option value='${item["name"]}'>${item["name"]}</option>";
                        } ?>
                    </select>
                    <div class="invalid-feedback">
                            Chọn danh mục cấp 1
                    </div>
                </div>
                <div class="col-md-12 mb-12">
                    <label class="form-label" for="categoryNameLv2">Danh mục cấp 2</label>
                    <select class="form-control" required name="categoryNameLv2" id="categoryNameLv2">
                    </select>
                    <div class="invalid-feedback">
                            Chọn danh mục cấp 2
                    </div>
                </div>
                <div class="col-md-12 mb-12">
                    <label class="form-label" for="categoryNameLv3">Danh mục cấp 3</label>
                    <select  class="form-control" id="categoryNameLv3" name="categoryNameLv3" required></select>
                    <div class="invalid-feedback">
                            Chọn danh mục cấp 3
                    </div>
                </div>
                <div class="col-md-12 mb-12">
                    <label class="form-label" for="thumbnail">Ảnh đại diện</label>
                    <img class='thumbnail-img' src="<?= $product["thumbnail"] ?>" alt="">
                    <input  type="file" accept=".jpg, .png, .jpeg, .gif" class="form-control" id="thumbnail" name="thumbnail" placeholder="Ảnh đại diện" 
                    >
                </div>
                <div class="col-md-12 mb-12">
                    <label class="form-label" for="galleries">Ảnh chi tiết</label>
                    <input multiple="multiple" accept=".jpg, .png, .jpeg, .gif" type="file" class="form-control" id="galleries" name="galleries[]" placeholder="Ảnh đại diện" 
                    >
                </div>
            </div>
        </div>
    </form>
</div>
<?php $this->view('frontend.public.footer') ?>
<?php $this->view('frontend.public.js.boostrapJS') ?>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $('#description').summernote({
    placeholder: 'Mô tả sản phẩm',
    tabsize: 2,
    height: 300,
    width:865,
    toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>
<script>
    $(document).ready(function(){

       

         // Load danh mục cấp 2
		$('#categoryNameLv1').on('change',function(){
			var categoryNameLV1 = $('#categoryNameLv1').find(":selected").text();
			$.ajax({
				url		: './index.php?controller=categorylv3&action=loadCategoryLv2',
				data	: {categoryNameLV1:categoryNameLV1},
				type	: 'POST',
				dataType: 'html',
				success : function(data){
                    $('#categoryNameLv2').html(data);
				}
			});
		});
        // load danh mục cấp 3
		$('#categoryNameLv2').on('change',function(){
			var categoryNameLV2 = $('#categoryNameLv2').find(":selected").text();
            console.log(categoryNameLV2)
			$.ajax({
				url		: './index.php?controller=categorylv3&action=loadCategoryLv3',
				data	: {categoryNameLV2:categoryNameLV2},
				type	: 'POST',
				dataType: 'html',
				success : function(data){
                    $('#categoryNameLv3').html(data);
				}
			});
		});

        // load hình ảnh thumbnail khi update
		$('#thumbnail').on('change',function(){
			var thumbnail = $(this).val();
            console.log(thumbnail);

			$.ajax({
				url		: './index.php?controller=product&action=loadThumbnail',
				data	: {thumbnail:thumbnail},
				type	: 'POST',
				dataType: 'html',
				success : function(data){
                    console.log(data);
				}
			});
		});
	});
</script>
</body>
</html>

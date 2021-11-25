<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <?php $this->view('frontend.public.base')?>
</head>
<body>
<?php $this->view('frontend.public.header')?>
<?php 
    if($alert != ''){
        echo "<div class='alert alert-danger' id='success-alert' style='top:100px'><strong>$alert !</strong></div>";
    }
?>

<div style="min-height: 450px;">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Ảnh đại diện</th>
                <th scope="col">Tên sản phẩm</th>
                <th scope="col">Danh mục</th>
                <th scope="col">Giá</th>
                <th scope="col">Giảm giá</th>
                <th scope="col">Chi tiết</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa</th>
            </tr>
        </thead>
        <tbody class="row-table"></tbody>
        </table>
</div>
<button type="button" class="mt-2 btn btn-sm createBtn btn-success">Thêm mới</button>
<nav style="margin:10px" aria-label="...">
    <ul class="pagination ml-2">
        <?php for ($i = 1; $i <= $pageTotal; $i++): ?>
            <li class="page-item">
                <a class="page-link"><?= $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>
<!-- Modal add  start -->
<div class="modal-layout">
    <div class="main-product-layout">
        <i class="fas fa-times close-btn"></i>
        <form method="POST" enctype="multipart/form-data" action="./index.php?controller=product&action=store" class="needs-validation" novalidate>
        <div class="form-row">
                <div class="col-md-8 mb-8">
                    <label class="form-label" for="title">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Tên sản phẩm" value=""
                        required>
                    <div class="invalid-feedback">
                        Nhập tên sản phẩm
                    </div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="price">Giá</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Giá" value=""
                        required>
                    <div class="invalid-feedback">
                        Nhập giá sản phẩm
                    </div>
                </div>
                <div class="col-md-2 mb-2">
                    <label class="form-label" for="discount">Giảm giá (%) </label>
                    <input type="number" class="form-control" id="discount" name="discount" placeholder="Giảm giá" value=""
                        required>
                    <div class="invalid-feedback">
                        Nhập giảm giá
                    </div>
                </div>
            </div>                
            <div class="form-row">
                <div class="col-md-8 mb-8">
                    <textarea style="resize: none; padding:10px" id="description" name="description" rows="10" cols="115"></textarea>   
                    <button id="submitBtn" class="mt-2 btn btn-primary" type="submit">Thêm mới</button>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="col-md-12 mb-12">
                        <label class="form-label" for="categoryNameLv1">Danh mục cấp 1</label>
                        <select class="form-control" required name="categoryNameLv1" id="categoryNameLv1">
                            <option value=""></option>
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
                        <input type="file" accept=".jpg, .png, .jpeg, .gif" class="form-control" id="thumbnail" name="thumbnail" placeholder="Ảnh đại diện" 
                            required>
                        <div class="invalid-feedback">
                            Chọn ảnh đại diện
                        </div>
                    </div>
                    <div class="col-md-12 mb-12">
                        <label class="form-label" for="details">Ảnh chi tiết</label>
                        <input multiple="multiple" accept=".jpg, .png, .jpeg, .gif" required type="file" class="form-control" id="detaisl" name="details[]" placeholder="Ảnh đại diện" 
                        >
                        <div class="invalid-feedback">
                            Chọn ảnh chi tiết
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $this->view('frontend.public.footer') ?>
<?php $this->view('frontend.public.js.boostrapJS') ?>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>
    $('#description').summernote({
    placeholder: 'Mô tả sản phẩm',
    tabsize: 2,
    height: 300,
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
        // Dữ liệu khi khởi tạo trang, mặc định trang 1
        $( "li.page-item" ).first().addClass('active')
        $.ajax({
            url		: './index.php?controller=product&action=LoadContent',
            dataType: 'html',
            success : function(data){
                $('.row-table').html(data);
                
            }
        });
        // Dữ liệu khi click trang
		$('a.page-link').on('click',function(){
			var _p = $(this).text();
			$.ajax({
				url		: './index.php?controller=product&action=LoadContent',
				data	: {page:_p},
				type	: 'POST',
				dataType: 'html',
				success : function(data){
                    $('.row-table').html(data);
					
				}
			});
		});
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
        $(".page-item").click(function () {
            // If the clicked element has the active class, remove the active class from EVERY .page-item>.state element
            if ($(this).hasClass("active")) {
                $(".page-item").removeClass("active");
            }
            // Else, the element doesn't have the active class, so we remove it from every element before applying it to the element that was clicked
            else {
                $(".page-item").removeClass("active");
                $(this).addClass("active");
            }
        });

        $(".createBtn").click(function(){
            $(".modal-layout").fadeIn()
        })
        $(".close-btn").click(function(){
            $(".modal-layout").fadeOut()
        })
       
	});
</script>
</body>
</html>

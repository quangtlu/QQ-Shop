<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục cấp 3</title>
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
            <th scope="col">Danh mục cấp 1</th>
            <th scope="col">Danh mục cấp 2</th>
            <th scope="col">Tên danh mục</th>
            <th scope="col">Mô tả</th>
            <th scope="col">Sửa</th>
            <th scope="col">Xóa</th>
            </tr>
        </thead>
        <tbody class="row-table"></tbody>
    </table>
</div>
<button type="button" class="btn createBtn btn-sm btn-success">Thêm mới</button>

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
    <div class="main-layout container">
        <i class="fas fa-times close-btn"></i>
        <form method="POST" action="./index.php?controller=categorylv3&action=store" class="needs-validation"
            novalidate>
            <div class="form-row">
                <div class="col-md-6 mb-6">
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
                <div class="col-md-6 mb-6">
                    <label class="form-label" for="categoryNameLv2">Danh mục cấp 2</label>
                    <select class="form-control" required name="categoryNameLv2" id="categoryNameLv2"></select>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-6">
                    <label class="form-label" for="name">Tên danh mục cấp 3</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tên danh mục" value=""
                        required>
                    <div class="invalid-feedback">
                        Nhập tên danh mục
                    </div>
                    <button id="submitBtn" class="mt-4 btn-sm btn btn-primary" type="submit">Thêm mới</button>
                </div>
                <div class="col-md-6 mb-6 mt-2">
                    <textarea style="resize: none; padding:10px" id="description" name="description" rows="10" cols="115"></textarea>
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
    placeholder: 'Mô tả danh mục',
    tabsize: 2,
    height: 150,
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
            url		: './index.php?controller=categorylv3&action=LoadContent',
            dataType: 'html',
            success : function(data){
                $('.row-table').html(data);
                
            }
        });
        // Dữ liệu khi click trang
		$('a.page-link').on('click',function(){
			var _p = $(this).text();
			$.ajax({
				url		: './index.php?controller=categorylv3&action=LoadContent',
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

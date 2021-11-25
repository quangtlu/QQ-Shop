<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <?php $this->view('frontend.public.base')?>
</head>

<body>
    <?php $this->view('frontend.public.header')?>
    <?php 
    if($alert != ''){
        echo "<div class='alert alert-danger' id='success-alert' style='top:100px'><strong>$alert !</strong></div>";
    }
?>

<div style="min-height: 550px;">
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Ngày đặt hàng</th>
                    <th>Tổng tiền</th>
                    <th>Chi tiết</th>
                    <th>Trạng thái</th>
                    <th>Hủy đơn</th>
                    <th>Xác nhận</th>
                </tr>
            </thead>
            <tbody class="row-table"></tbody>
        </table>
    </div>
    <nav style="margin:10px" aria-label="...">
        <ul class="pagination ml-2">
            <?php for ($i = 1; $i <= $pageTotal; $i++): ?>
            <li class="page-item">
                <a class="page-link"><?= $i; ?></a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <div class="modal-layout">
        <div class="modal-form-info">
            <i class="exitBtn fas fa-times"></i>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Đơn hàng</th>
                        <th>Số lượng</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn Giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                    <tbody id="content"></tbody>
                <!-- Phân trang -->
            </table>
        </div>
    </div>
    <?php $this->view('frontend.public.footer') ?>
    <?php $this->view('frontend.public.js.boostrapJS') ?>

    <script>
    $(document).ready(function() {
        // Dữ liệu khi khởi tạo trang, mặc định trang 1
        $("li.page-item").first().addClass('active')
        $.ajax({
            url: './index.php?controller=order&action=LoadContent',
            dataType: 'html',
            success: function(data) {
                $('.row-table').html(data);
                // Load chi tiết đơn hàng
                $('.detailBtn').click(function(){
                    var id = $(this).attr("data-id")
                    $('.modal-layout').fadeIn()
                    $.ajax({
                        url: './index.php?controller=order&action=detail',
                        dataType: 'html',
                        data: {
                            id: id
                        },
                        type: "POST",
                        success: function(data) {
                            $('#content').html(data);
                        }
                    });

                })
                // hide modal
                $('.exitBtn').click(function() {
                    $('.modal-layout').fadeOut()
                })

            }
        });
        
        // Dữ liệu khi click trang
        $('a.page-link').on('click', function() {
            var _p = $(this).text();
            $.ajax({
                url: './index.php?controller=order&action=LoadContent',
                data: {
                    page: _p
                },
                type: 'POST',
                dataType: 'html',
                success: function(data) {
                    $('.row-table').html(data);
                    // Load chi tiết đơn hàng
                    $('.detailBtn').click(function(){
                        var id = $(this).attr("data-id")
                        console.log(id)
                        $('.modal-layout').fadeIn()
                        $.ajax({
                            url: './index.php?controller=order&action=detail',
                            dataType: 'html',
                            data: {
                                id: id
                            },
                            type: "POST",
                            success: function(data) {
                                $('#content').html(data);
                            }
                        });

                    })
                    // hide modal
                    $('.exitBtn').click(function() {
                        $('.modal-layout').fadeOut()
                    })
                }
            });
        });
       
        $(".page-item").click(function() {
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

    });
    </script>
</body>

</html>
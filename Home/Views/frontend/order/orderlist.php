<!DOCTYPE html>
<html>

<head>
    <title>Đơn hàng</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php $this->view("frontend.public.base") ?>

</head>

<body>
    <?php $this->view("frontend.public.header") ?>
    <div class="hide-when-search">
        <!-- breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
                    <li><a href="./"><span class="glyphicon fas fa-home" aria-hidden="true"></span>Trang chủ</a></li>
                    <li class="active">Đơn hàng</li>
                </ol>
            </div>
        </div>
        <!-- //breadcrumbs -->
        <!-- checkout -->
        <div class="checkout">
            <div class="container">
                <table class="timetable_sub">
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
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $stt = 0; 
                            for($i=0;$i<count($orders);$i++){
                                $stt = $i + 1;
                                $totalMoney_formated = number_format($totalMoney[$i]["total"], 0, '', ',');
                                echo "
                                <tr class='rem1 animated wow fadeInUp' data-wow-delay='.5s'>
                                    <td>$stt</td>
                                    <td>".$orders[$i]["fullname"]."</td>
                                    <td>".$orders[$i]["phone"]."</td>
                                    <td>".$orders[$i]["address"]."</td>
                                    <td>".$orders[$i]["order_date"]."</td>
                                    <td>$totalMoney_formated VNĐ</td>
                                    <td><i data-id='".$orders[$i]["id"]."' class='detailBtn fas fa-eye'></i></td>
                                    ";
                                    if($orders[$i]["status"] == 0){
                                        echo 
                                       "
                                        <td ><span style='font-weight:500;color:red'>Chưa xác nhận</span></td>
                                        <td><a href='./index.php?controller=order&action=delete&id=".$orders[$i]["id"]."'>
                                        <button type='button' class='btn btn-danger btn-sm'>Hủy</button>
                                        </a></td>
                                        ";
                                        
                                    }
                                    if($orders[$i]["status"] >= 1){
                                        echo 
                                        "<td ><span style='font-weight:500;color:green'>Đã xác nhận</span></td>
                                        <td><button type='button' class='btn btn-danger btn-sm disabled'>Hủy</button></td>
                                        ";
                                    }
                                    echo "
                                </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-layout">
            <div class="modal-form-info">
                <i class="exitBtn fas fa-times"></i>
                <table class="timetable_sub">
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
            <!-- Search results -->
            <div class="new-collections">
            <div class='container'>
                <!-- Sản phẩm -->
                <h3 class='title-list-product animated wow zoomIn' data-wow-delay='.5s'>Danh sách sản phẩm</h3>
                <div class='list-product new-collections-grids'></div>
                <!-- Phân trang -->
                <nav style="margin:10px" aria-label="...">
                    <ul class="pagination ml-2">
                        <?php for ($i = 1; $i <= $pageTotal; $i++): ?>
                        <li class="page-item-search">
                            <a style="cursor: pointer;" class="page-link"><?= $i; ?></a>
                        </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- Search results -->
    <div class="new-collections">
        <div class='container'>
            <!-- Sản phẩm -->
            <h3 class='title-list-product animated wow zoomIn' data-wow-delay='.5s'>Danh sách sản phẩm</h3>
            <div class='list-product new-collections-grids'></div>
            <!-- Phân trang -->
            <nav style="margin:10px" aria-label="...">
                <ul class="pagination ml-2">
                    <?php for ($i = 1; $i <= $pageTotal; $i++): ?>
                    <li class="page-item-search">
                        <a style="cursor: pointer;" class="page-link"><?= $i; ?></a>
                    </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        </div>
    </div>
    <!-- Search results -->
    <?php $this->view("frontend.public.footer") ?>
    <script>
$(document).ready(function() {
    $('.new-collections').hide()

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
    

});
</script>
</body>
</html>
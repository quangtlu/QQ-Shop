<!DOCTYPE html>
<html>

<head>
    <title>Chi tiết đơn hàng</title>
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
                    <li class="active">Giỏ hàng</li>
                </ol>
            </div>
        </div>
        <!-- //breadcrumbs -->
        <!-- checkout -->
        <div class="container mt-3" <?php if($flag) echo "style='display:none'"?>>
            <div class="alert alert-danger" role="alert" >
                Giỏ hàng trống !
            </div>
            <div class="mb-5 checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
                <a href="javascript:history.back()">
                    <i class="glyphicon fas fa-arrow-left" aria-hidden="true"></i>
                    <span style="padding-left:10px">Tiếp tục mua sắm</span>
                </a>
            </div>
        </div>
        <div class="checkout" <?php if(!$flag) echo "style ='display:none'";?>>
            <div class="container">
                <form method="Post" action="./index.php?controller=order&action=buy">
                    <div class="checkout-right animated wow slideInUp" data-wow-delay=".5s">
    
                        <table class="timetable_sub">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Đơn hàng</th>
                                    <th>Số lượng</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Đơn Giá</th>
                                    <th>Thành tiền</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                                <tbody id="content"></tbody>
                            <!-- Phân trang -->
                        </table>
                        <nav style="margin:10px" aria-label="...">
                            <ul class="pagination ml-2">
                                <?php for ($i = 1; $i <= $pageTotal; $i++): ?>
                                <li class="page-item">
                                    <a style="cursor: pointer;" class="page-link"><?= $i; ?></a>
                                </li>
                                <?php endfor; ?>
                            </ul>
                        </nav>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Mua hàng</button>
                </form>
                <div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
                    <a href="javascript:history.back()">
                        <i class="glyphicon fas fa-arrow-left" aria-hidden="true"></i>
                        <span style="padding-left:10px">Tiếp tục mua sắm</span>
                    </a>
                </div>
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
        // Ẩn kết quả tìm kiếm
        $('.new-collections').hide()
        // Load sản phẩm trong giỏ hàng
        $.ajax({
            url: './index.php?controller=order&action=loadOrder',
            type: 'POST',
            dataType: 'html',
            success: function(data) {
                $('#content').html(data);
                // Xóa sản phẩm trong giỏ hàng
                $('.removeBtn').on('click', function() {
                    var id = $(this).attr("data-id");
                    $.ajax({
                        url: './index.php?controller=order&action=remove',
                        data: {
                            id: id
                        },
                        type: 'GET',
                        dataType: 'html',
                    });

                    $(this).closest('.rem1').hide()
                });
                // thay đổi số lượng
                $('.quantity').on('change', function() {
                    var quantity = $(this).val()
                    var priceString = $(this).closest('.rem1').children('.price').text()

                    var priceNumber = Number(priceString.replace(/[^0-9.-]+/g, ""));
                    var total = quantity * priceNumber
                    var totalFormat = total.toLocaleString('it-IT', {
                        style: 'currency',
                        currency: 'VND'
                    });
                    //  thay đổi thành tiền của từng sản phẩm
                    $(this).closest('.rem1').children('.total-money').html(totalFormat)
                    var orderList = $('tr.rem1')
                    var totalMoney = 0;
                    var totalQuantity = 0;

                    orderList.each(function(index) {
                        var total = Number($(this).find(".total-money").text()
                            .replace(/[^0-9]/g, ''))
                        var quantity = Number($(this).find('.quantity').val());
                        totalQuantity += quantity;
                        totalMoney += total;
                    })
                    var totalMoneyFormat = totalMoney.toLocaleString('it-IT', {
                        style: 'currency',
                        currency: 'VND'
                    });

                    $('.total-money-checkout').html(totalMoneyFormat)
                    
                })
            }
        });


        // Dữ liệu khi click next trang
        $('a.page-link').on('click', function() {
            var _p = $(this).text();
            $.ajax({
                url: './index.php?controller=order&action=loadOrder',
                data: {
                    page: _p
                },
                type: 'POST',
                dataType: 'html',
                success: function(data) {
                    $('#content').html(data);

                    // Khi click xóa sản phẩm
                    $('.removeBtn').on('click', function() {
                        var id = $(this).attr("data-id");
                        $.ajax({
                            url: './index.php?controller=order&action=remove',
                            data: {
                                id: id
                            },
                            type: 'GET',
                            dataType: 'html',

                        });
                        // Ẩn sản phẩm
                        $(this).closest('.rem1').hide()
                    });
                    // thay đổi giá tiền theo số lượng
                    $('.quantity').on('change', function() {
                        var quantity = $(this).val()
                        var priceString = $(this).closest('.rem1').children(
                            '.price').text()

                        var priceNumber = Number(priceString.replace(/[^0-9.-]+/g,
                            ""));
                        var total = quantity * priceNumber
                        var totalFormat = total.toLocaleString('it-IT', {
                            style: 'currency',
                            currency: 'VND'
                        });

                        $(this).closest('.rem1').children('.total-money').html(
                            totalFormat)
                    })
                }
            });
        });

        // Active số trang khi click
        $("li.page-item").first().addClass('active')
        $(".page-item").click(function() {
            if ($(this).hasClass("active")) {
                $(".page-item").removeClass("active");
            } else {
                $(".page-item").removeClass("active");
                $(this).addClass("active");
            }
        });
    });
    </script>
</body>

</html>
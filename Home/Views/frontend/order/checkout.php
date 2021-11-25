<!DOCTYPE html>
<html>

<head>
    <title>Thanh toán</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php $this->view("frontend.public.base") ?>

</head>

<body>
    <?php $this->view("frontend.public.header") ?>

    <!-- breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
                <li><a href="./"><span class="glyphicon fas fa-home" aria-hidden="true"></span>Trang chủ</a></li>
                <li class="active">Thanh toán</li>
            </ol>
        </div>
    </div>
    <!-- //breadcrumbs -->
    <!-- checkout -->
    <div class="checkout">
        <div class="container">
            <form method="Post" action="./index.php?controller=order&action=checkout">
                <div class="row">
                    <div class="order-info col-md-8">
                        <ul style="list-style:none"
                            <?php if(isset($_SESSION["phone"])) echo "data-id='".$_SESSION["phone"]."'" ; ?>
                            id="customer-info" class="list-group">
                            <li style="background-color: #D8703F;color:#fff"
                                class="list-group-item list-group-item-action">
                                Thông tin khách hàng
                                <button id="changeBtn" type="button" class="btn btn-sm btn-outline-info">Thay
                                    đổi</button>
                            <li class="info-detail"></li>
                            </li>
                        </ul>
                    </div>
                    <div class="order-info col-md-4">
                        <ul class="list-group">
                            <li style="background-color: #D8703F;color:#fff"
                                class="list-group-item list-group-item-action">
                                Thông tin đơn hàng</li>
                            <li class="list-group-item list-group-item-action">Tổng sản phẩm: <i></i> <b
                                    style="color:#D8703F" class="total-quantity"><?= $totalQuantity ?></b></li>
                            <li class="list-group-item list-group-item-action">Thanh toán: <i></i> <b
                                    style="color:#D8703F">Thanh toán khi nhận hàng</b></li>
                            <li class="list-group-item list-group-item-action">Tổng thanh toán: <i></i> <b
                                    style="color:#D8703F" class="total-money-checkout"><?= $totalMoney_formated ?> VNĐ</b>
                            </li>
                        </ul>
                    </div>
                </div>
                    <input id="fullname-input" type="text" name="fullname"  hidden>
                    <input id="phone-input" type="tel" name="phone"  hidden>
                    <input id="address-input" type="text" name="address"  hidden>
                <button style="background-color:#D8703F;color:#fff" type="submit" class="btn mt-3">Đặt hàng</button>
            </form>
        </div>
        <div class="modal-layout">
            <div class="modal-form-info">
                <i class="closeBtn fas fa-times"></i>
                <form class="info-form needs-validation" method="POST" action="./index.php?controller=order&action=buy"
                    novalidate>
                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Họ và tên</label>
                            <input required id="fullname" type="text" class="form-control" name="fullname"
                                placeholder="Nhập họ tên">
                            <div class="invalid-feedback">
                                Vui lòng nhập họ tên !
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input required id="phone" type="tel" class="form-control" name="phone"
                                placeholder="Nhập số điện thoại">
                            <div class="invalid-feedback">
                                Vui lòng nhập số điện thoại !
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="province">Tỉnh/Thành Phố</label>
                            <select required id="province" class="form-control" name="province"></select>
                            <div class="invalid-feedback">
                                Chọn tỉnh/thành phố
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="district">Quận/huyện</label>
                            <select required id="district" class="form-control" name="district"></select>
                            <div class="invalid-feedback">
                                Chọn quận/huyện
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="ward">Phường/xã</label>
                            <select required id="ward" class="form-control" name="ward"></select>
                            <div class="invalid-feedback">
                                Chọn phường/xã
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label" for="street">Thôn/Đường</label>
                            <input required id="street" class="form-control" name="street">
                            <div class="invalid-feedback">
                                Nhập tên thôn/đường
                            </div>
                        </div>
                    </div>
                    <button type="button" class="cancelBtn btn btn-danger">Hủy</button>
                    <button type="submit" class="btn btn-success">Xác nhận</button>
                </form>
            </div>
        </div>
    </div>
    <?php $this->view("frontend.public.footer") ?>
    <?php $this->view('frontend.public.vietnamlocalselectormaster.vietnamlocalselector') ?>

<script>
$(document).ready(function() {

    // Load thông tin khách hàng mặc định
    var phone = $('#customer-info').attr("data-id")
    $.ajax({
        url: './index.php?controller=user&action=userInfo',
        dataType: 'html',
        data: {
            phone: phone
        },
        type: "POST",
        success: function(data) {
            $('.info-detail').html(data);
        }
    });
    // show modal 
    $('#changeBtn').click(function() {
        $('.modal-layout').fadeIn()
    })
    // hide modal
    $('.closeBtn').click(function() {
        $('.modal-layout').fadeOut()
    })
    $('.cancelBtn').click(function() {
        $('.modal-layout').fadeOut()
    })
    // get data from form
    $('.info-form').submit(function(event) {
        event.preventDefault();
        var fullname = $('#fullname').val()
        var phone = $('#phone').val()
        var province = $('#province').val()
        var distinct = $('#district').val()
        var ward = $('#ward').val()
        var street = $('#street').val()

        $('.info-detail').html(
            `
                <li class='list-group-item list-group-item-action'>Họ tên: <i></i> <b style='color:#D8703F' class='fullname-item'>${fullname}</b></li>
                <li class='list-group-item list-group-item-action'>Số điện thoại: <i></i> <b style='color:#D8703F' class='phone-item'>${phone}</b></li>
                <li class='list-group-item list-group-item-action'>Địa chỉ: <i></i> <b style='color:#D8703F' class='address-item'>${street}, ${ward}, ${distinct}, ${province}</b></li>`
        );
        $('#fullname-input').val(fullname)
        $('#phone-input').val(phone)
        $('#address-input').val($('.address-item').text())

        $('.modal-layout').hide()
    })

});
</script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();
</script>
</body>

</html>
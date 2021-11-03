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
    
    <!-- breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
				<li><a href="./"><span class="glyphicon fas fa-home" aria-hidden="true"></span>Trang chủ</a></li>
				<li class="active">Chi tiết đơn hàng</li>
			</ol>
		</div>
	</div>
<!-- //breadcrumbs -->
<!-- checkout -->
	<div class="checkout">
		<div class="container">
			<h3 class="animated wow slideInLeft" data-wow-delay=".5s">Đơn hàng của bạn bao gồm: <span><?= count($productList) ?> sản phẩm</span></h3>
			<div class="checkout-right animated wow slideInUp" data-wow-delay=".5s">
				<table class="timetable_sub">
					<thead>
						<tr>
							<th>STT</th>	
							<th>Đơn hàng</th>
							<th>Số lượng</th>
							<th>Tên sản phẩm</th>
							<th>Giá</th>
							<th>Xóa</th>
						</tr>
					</thead>                        
                    <?php 
                        $stt = 0;
                        for($i=0; $i< count($productList); $i++){
                            $stt = $i + 1;
                            $imgPath = $this->fixUrl($productList[$i]["thumbnail"],"./");

                            $current_price = $productList[$i]["discount"] !=0 ? ($productList[$i]["price"] - $productList[$i]["price"]*($productList[$i]["discount"]/100))  :  $productList[$i]["price"];

                            $current_price_formated = number_format($current_price, 0, '', ',');

                        echo "
                            <tr class='rem1'>
                                <td class='invert'>$stt</td>
                                <td class='invert-image'><a href='single.html'><img src='$imgPath' alt=' ' class='img-responsive' /></a></td>
                                <td class='invert'>
                                    <div class='quantity'> 
                                        <div class='quantity-select'>                           
                                            <div class='entry value-minus'>&nbsp;</div>
                                            <div class='entry value'><span>1</span></div>
                                            <div class='entry value-plus active'>&nbsp;</div>
                                        </div>
                                    </div>
                                </td>
                                <td class='invert'>".$productList[$i]["title"]."</td>
                                <td class='invert'>".$current_price_formated."₫</td>
                                <td class='invert'>
                                    <div class='rem'>
                                        <i style='color:red;cursor:pointer' class='fas fa-trash-alt'></i>
                                    </div>
                                </td>
                            </tr>
                        ";

                    } ?>
				</table>
			</div>
			<div class="checkout-left">	
				<div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
					<h4>Continue to basket</h4>
					<ul>
						<li>Product1 <i>-</i> <span>$250.00 </span></li>
						<li>Product2 <i>-</i> <span>$290.00 </span></li>
						<li>Product3 <i>-</i> <span>$299.00 </span></li>
						<li>Total Service Charges <i>-</i> <span>$15.00</span></li>
						<li>Total <i>-</i> <span>$854.00</span></li>
					</ul>
				</div>
				<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
					<a href="single.html"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
<!-- //checkout -->

    <?php $this->view("frontend.public.footer") ?>
    <!--quantity-->
    <script>
        $('.value-plus').on('click', function(){
            var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)+1;
            divUpd.text(newVal);
        });

        $('.value-minus').on('click', function(){
            var divUpd = $(this).parent().find('.value'), newVal = parseInt(divUpd.text(), 10)-1;
            if(newVal>=1) divUpd.text(newVal);
        });
    </script>
<!--quantity-->
</body>

</html>
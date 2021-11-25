<?php 
    class OrderController extends BaseController{

        private $productModel;
        private $orderDetailModel;
        private $userModel;
        private $orderModel;


        public function __construct()
        {
            $this->loadModel("ProductModel");
            $this->productModel = new ProductModel();
            $this->loadModel("OrderDetailModel");
            $this->orderDetailModel = new OrderDetailModel();

            $this->loadModel("UserModel");
            $this->userModel = new UserModel();
            $this->loadModel("OrderModel");
            $this->orderModel = new OrderModel();
            session_start();


        }
        public function index(){
            if(!empty($_SESSION["cart"])){
                $productIDs = $_SESSION["cart"];
                $productOnePage = 10; // Số sản phẩm trên 1 trang
                $pageTotal = ceil(count($productIDs)/$productOnePage);
                $flag = true;
            }
            else{
                $flag = false;
                $pageTotal = 0;
                
            }
            return $this->view("frontend.order.index",[
                "pageTotal" => $pageTotal,
                "flag" => $flag
            ]);

        }
        public function loadOrder(){
                $productIDs = $_SESSION["cart"];
                $current_page = isset($_POST['page']) ? $_POST['page'] : 1;
                $productOnePage = 10; // Số sản phẩm trên 1 trang
                
                $productList = [];

                $max = $productOnePage*$current_page > count($productIDs) ? count($productIDs) : $productOnePage*$current_page;

                for($i = ($current_page - 1)*$productOnePage; $i < $max; $i++){
                    array_push($productList,$this->productModel->findById($productIDs[$i]));
                }
                $stt = 0;
                for($i=0; $i< count($productList); $i++){
                    $stt = $i + 1;
                    $imgPath = $this->fixUrl($productList[$i]["thumbnail"],"./");

                    $current_price = $productList[$i]["discount"] !=0 ? ($productList[$i]["price"] - $productList[$i]["price"]*($productList[$i]["discount"]/100))  :  $productList[$i]["price"];

                    $current_price_formated = number_format($current_price, 0, '', ',');

                    echo "
                        <tr data-id='".$productList[$i]["id"]."' class='rem1 animated wow fadeInUp' data-wow-delay='.5s'>
                            <td style='width:40px' class='invert'>$stt</td>
                            <td style='width:100px' class='invert-image'><a href='./index.php?controller=product&action=detail&id=".$productList[$i]["id"]."'><img src='$imgPath' alt=' ' class='img-responsive' /></a></td>
                            <td style='width:80px' class='invert quantity-col'>
                                <input name='quantity[]' class='quantity form-control' style='text-align: center;' type='number' min='1' value=1
                                onchange='if(this.value<0){this.value= this.value * -1} if(this.value==0){this.value= 1}' class='form-control'>
                            </td>
                            <td class='invert title-td'><span class='short-text'>".$productList[$i]["title"]."</span></td>
                            <td style='width:100px' class='price invert'>".$current_price_formated."VND</td>
                            <td data-id='".$current_price."' style='width:100px' class='total-money invert'>".$current_price_formated."VND</td>
                            <td style='width:40px' class='invert'>
                                <div class='rem'>
                                    <i style='color:red;cursor:pointer' data-id='".$productList[$i]["id"]."'' class='removeBtn fas fa-trash-alt'></i>
                                </div>
                            </td>
                        </tr>
                    ";
                }
                
            

            
        }
        //  Số lượng sản phẩm trong giỏ hàng
        public function NumProduct(){
            $flag = true;
            
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart']=array();
            }
            else{
                if(isset($_POST["id"])){
                    foreach($_SESSION['cart'] as $item){
                        if($item == $_POST["id"]){
                            $flag = false;
                        }
                    }
                    if($flag == true){
                        array_push($_SESSION['cart'],$_POST["id"]);
                    }
                }
            }
            echo count($_SESSION['cart']);
        }
        // Xóa sản phẩm trong giỏ hàng
        public function remove(){
            if(isset($_GET["id"])){
                for($i = 0; $i < count($_SESSION["cart"]); $i++){
                    if($_SESSION["cart"][$i] == $_GET["id"]){
                        unset($_SESSION["cart"][$i]);
                    }
                }
                $_SESSION["cart"] = array_values($_SESSION["cart"]);
            }
        }
        public function buy(){
            if(!empty($_SESSION["cart"])){
                $productIDs = $_SESSION["cart"];
                $quantitys = $_POST["quantity"];
                $products = [];
                $money = [];
    
                foreach($productIDs as $item){
                    array_push($products,$this->productModel->findById($item));
                }
                for($i=0;$i<count($products);$i++){
                    array_push($money,$this->productModel->getSum($products[$i]['id'],$products[$i]['price'],$products[$i]['discount'],$quantitys[$i]));
                }
                $totalMoney = 0;
                foreach($money as $item){
                    $totalMoney += $item["total"];
                }
                $totalQuantity = 0;
                foreach($quantitys as $item){
                    $totalQuantity += $item;
                }
                $totalMoney_formated = number_format($totalMoney, 0, '', ',');
                $_SESSION["productIDs"] = $productIDs;
                $_SESSION["quantitys"] = $quantitys;
    
                return $this->view("frontend.order.checkout",[
                    "totalQuantity" => $totalQuantity,
                    "totalMoney_formated" => $totalMoney_formated,
    
                ]);
            }
            else{
                header("Location: ./index.php?controller=home");
            }

        }
        public function checkout(){
            if(isset($_SESSION["productIDs"]) && isset($_SESSION["quantitys"]) && isset($_SESSION["phone"])){
                $productIDs = $_SESSION["productIDs"];
                $quantitys = $_SESSION["quantitys"];
                $phoneUser = $_SESSION["phone"];
                $userInfo = $this->userModel->findByCondition("phone",$phoneUser);
                $userID = $userInfo["id"];

                if(!empty($_POST["fullname"]) && !empty($_POST["phone"]) && !empty($_POST["address"])){
                    $fullname = $_POST["fullname"];
                    $phone = $_POST["phone"];
                    $address = $_POST["address"];
                }
                else{
                    $fullname = $userInfo["fullname"];
                    $phone = $userInfo["phone"];
                    $address = $userInfo["address"];
                }

                $orderData = [
                    'fullname' => $fullname,
                    'phone' => $phone,
                    'address' => $address,
                    'user_id' => $userID,
                ];

                $this->orderModel->store($orderData);
                $oderID = $this->orderModel->getMax("id")["id"];
                
                for($i=0;$i<count($productIDs);$i++){
                    $data = [
                        "order_id" => $oderID,
                        "product_id" => $productIDs[$i],
                        "quantity" => $quantitys[$i],
                    ];
                    $this->orderDetailModel->store($data);
                }
                unset($_SESSION["cart"]);
                unset($_SESSION["productIDs"]);
                unset($_SESSION["quantitys"]);
                header("Location: ./index.php?controller=order&action=orderList");
            }
        }
        public function orderList(){
            if(isset($_SESSION["phone"])){
                $userID = $this->userModel->findByCondition("phone",$_SESSION["phone"])["id"];
                $orders = $this->orderModel->findAllByCondition("user_id",$userID);
                $totalMoney = [];
                foreach($orders as $item){
                    array_push($totalMoney,$this->orderDetailModel->getTotal($item["id"]));
                }
                return $this->view("frontend.order.orderlist",[
                    "orders" => $orders,
                    "totalMoney" => $totalMoney,
                ]);
            }

        }
        public function delete(){
            if(isset($_GET["id"])){
                $orderID = $_GET["id"];
                $orderDetails = $this->orderDetailModel->findAllByCondition("order_id",$orderID);
                foreach($orderDetails as $item){
                    $this->orderDetailModel->deleteData($item["id"]);
                }
                $this->orderModel->deleteData($orderID);
                header("Location: ./index.php?controller=order&action=orderList");
            }
        }
        public function detail(){
            if(!empty($_POST["id"])){
                $id = $_POST["id"];
                $orderDetails = $this->orderDetailModel->findAllByCondition("order_id",$id);
                $productList = [];
                foreach($orderDetails as $item){
                    array_push($productList,$this->productModel->findById($item["product_id"]));
                }
                $stt = 0;
                for($i=0; $i< count($productList); $i++){
                    $stt = $i + 1;
                    $imgPath = $this->fixUrl($productList[$i]["thumbnail"],"./");

                    $current_price = $productList[$i]["discount"] !=0 ? ($productList[$i]["price"] - $productList[$i]["price"]*($productList[$i]["discount"]/100))  :  $productList[$i]["price"];
                    $totalMoney = $current_price * $orderDetails[$i]["quantity"];

                    $totalMoney_formated = number_format($totalMoney, 0, '', ',');
                    $current_price_formated = number_format($current_price, 0, '', ',');

                    echo "
                        <tr data-id='".$productList[$i]["id"]."' class='rem1 animated wow fadeInUp' data-wow-delay='.5s'>
                            <td style='width:40px' class='invert'>$stt</td>
                            <td style='width:100px' class='invert-image'><a href='./index.php?controller=product&action=detail&id=".$productList[$i]["id"]."'><img src='$imgPath' alt=' ' class='img-responsive' /></a></td>
                            <td style='width:80px' class='invert quantity-col'>
                                ".$orderDetails[$i]["quantity"]."
                            </td>
                            <td class='invert title-td'><span class='short-text'>".$productList[$i]["title"]."</span></td>
                            <td style='width:100px' class='price invert'>".$current_price_formated."VND</td>
                            <td data-id='".$current_price."' style='width:100px' class='total-money invert'>".$totalMoney_formated."VND</td>
                        </tr>
                    ";
                }
            }
        }
    }
?>

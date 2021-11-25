<?php 
    class OrderController extends BaseController{

        private $productModel;
        private $orderDetailModel;
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
        public function index($alert=''){
            $orderTotal = $this->orderModel->getNumRecord();
            $postOnePage = 5; 
            $pageTotal = ceil($orderTotal / $postOnePage);
            
            return $this->view('frontend.order.index',[
                "pageTotal" => $pageTotal,
                "alert" => $alert,
            ]);
            
        }
        public function LoadContent(){
            $current_page = isset($_POST['page']) ? $_POST['page'] : 1;
            $postOnePage = 5; // Số bài viết hiển thị trong 1 trang.
            // Khi đã có tổng số bài viết và số bài viết trong một trang ta có thể tính ra được tổng số trang
            $startRecord = ($current_page - 1) * $postOnePage;
            $orders = $this->orderModel->getAllLimit($startRecord, $postOnePage);
            $totalMoney = [];
            foreach($orders as $item){
                array_push($totalMoney,$this->orderDetailModel->getTotal($item["id"]));
            }
            $stt =0;
            for($i = 0; $i < count($orders); $i++){
                $stt = $i + 1;
                $totalMoney_formated = number_format($totalMoney[$i]["total"], 0, '', ',');
                echo 
                "
                    <tr data-id='".$orders[$i]["status"]."' class='rem1 animated wow fadeInUp' data-wow-delay='.5s'>
                        <td>$stt</td>
                        <td>".$orders[$i]["fullname"]."</td>
                        <td>".$orders[$i]["phone"]."</td>
                        <td>".$orders[$i]["address"]."</td>
                        <td>".$orders[$i]["order_date"]."</td>
                        <td>$totalMoney_formated VNĐ</td>
                        <td><i data-id='".$orders[$i]["id"]."' class='detailBtn fas fa-eye'></i></td>
                        ";
                        if($orders[$i]["status"] == 0){
                            echo "<td ><span style='color:red;font-weight:bold'>Chưa xác nhận</span></td>
                                  <td><a href='./index.php?controller=order&action=delete&id=".$orders[$i]["id"]."'><button type='button' class='btn btn-danger btn-sm'>Hủy</button></a></td>
                                  <td><a href='./index.php?controller=order&action=confirm&id=".$orders[$i]["id"]."'>
                                    <button type='button' class='btn btn-success btn-sm'>Xác nhận</button>
                                </a></td>
                            ";
                        }
                        if($orders[$i]["status"] == 1){
                            echo "<td ><span style='color:green;font-weight:bold'>Đã xác nhận</span></td>
                                  <td><button type='button' class='btn btn-danger btn-sm' disabled>Hủy</button></td>
                                  <td><button type='button' class='btn btn-success btn-sm' disabled>Xác nhận</button></td>
                            ";
                        }
                        echo 
                        "
                    </tr>
                ";
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
                    $imgPath = $this->fixUrl($productList[$i]["thumbnail"]);

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


        public function delete(){
            if(isset($_GET["id"])){
                $orderID = $_GET["id"];
                $orderDetails = $this->orderDetailModel->findAllByCondition("order_id",$orderID);
                foreach($orderDetails as $item){
                    $this->orderDetailModel->deleteData($item["id"]);
                }
                $this->orderModel->deleteData($orderID);
                header("Location: ./index.php?controller=order");
            }
        }
        public function confirm(){
            if(isset($_GET["id"])){
                $this->orderModel->updateData($_GET["id"],["status" => 1]);
                header("Location: ./index.php?controller=order");
            }
        }

    }
?>

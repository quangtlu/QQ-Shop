<?php 
    class OrderController extends BaseController{

        private $productModel;
        public function __construct()
        {
            $this->loadModel("ProductModel");
            $this->productModel = new ProductModel();
        }
        public function index(){
            session_start();

            if(isset($_SESSION["cart"])){
                $productIDs = $_SESSION["cart"];

                $productList = [];

                foreach($productIDs as $item){
                    array_push($productList,$this->productModel->findById($item));
                }
                
                return $this->view("frontend.order.index",[
                    "productList" => $productList
                ]);
            }
            
        }
        //  Số lượng sản phẩm trong giỏ hàng
        public function NumProduct(){
            session_start();
            $flag = true;
            
            if(!isset($_SESSION['cart'])){
                $_SESSION['cart']=array();
                echo 0;
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
                echo count($_SESSION['cart']);
            }
            

        }
    
    }
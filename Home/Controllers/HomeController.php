<?php 
    class HomeController extends BaseController{
        private $productModel;
        private $userModel;


        public function __construct()
        {
            $this->loadModel("ProductModel");
            $this->productModel = new ProductModel();

            $this->loadModel("UserModel");
            $this->userModel = new UserModel();
        }
        
        public function index(){
            $products = $this->productModel->getAll();
            $productOnePage = 4;
            $TotalProduct = count($products);
            $pageTotal = ceil($TotalProduct/$productOnePage);
           return $this->view('frontend.home.index',[
                "pageTotal" => $pageTotal
           ]);
        }

        public function loadcontent(){
            $current_page = isset($_POST['page']) ? $_POST['page'] : 1;
            $productOnePage = 4; // Số sản phẩm trên 1 trang
            $startRecord = ($current_page - 1) * $productOnePage;
            $data = $this->productModel->getAllLimit($startRecord, $productOnePage);
            
            for($i = 0; $i < count($data); $i++){
                    $old_price_formated = number_format($data[$i]["price"], 0, '', ',');
                    $current_price = $data[$i]["discount"] !=0 ? ($data[$i]["price"] - $data[$i]["price"]*($data[$i]["discount"]/100)) :  $data[$i]["price"];
                    $current_price_formated = number_format($current_price, 0, '', ',');
                    $img_path = $this->fixUrl($data[$i]["thumbnail"],"./");
                    echo 
                    "
                    <div class='col-md-3 new-collections-grid mt-3'>
                        <div class='new-collections-grid1 animated wow fadeInUp' data-wow-delay='.5s'>
                            <div class='new-collections-grid1-image'>
                                <a href='./index.php?controller=product&action=detail&id=".$data[$i]["id"]."' class='product-image'><img src='".$img_path."' alt=' '
                                        class='img-responsive' /></a>
                                <div class='new-collections-grid1-image-pos'>
                                    <a href='./index.php?controller=product&action=detail&id=".$data[$i]["id"]."'>Xem chi tiết</a>
                                </div>
                                <div class='new-collections-grid1-right'>
                                    <div class='rating'>
                                        <div class='rating-left'>
                                            <!-- Ảnh icon sao rating -->
                                            <img src='./Home/Views/frontend/public/web/images/2.png' alt=' ' class='img-responsive' />
                                        </div>
                                        <div class='rating-left'>
                                            <img src='./Home/Views/frontend/public/web/images/2.png' alt=' ' class='img-responsive' />
                                        </div>
                                        <div class='rating-left'>
                                            <img src='./Home/Views/frontend/public/web/images/2.png' alt=' ' class='img-responsive' />
                                        </div>
                                        <div class='rating-left'>
                                            <img src='./Home/Views/frontend/public/web/images/2.png' alt=' ' class='img-responsive' />
                                        </div>
                                        <div class='rating-left'>
                                            <img src='./Home/Views/frontend/public/web/images/1.png' alt=' ' class='img-responsive' />
                                        </div>
                                        <div class='clearfix'> </div>
                                    </div>
                                </div>
                            </div>
                            <h4><a>".$data[$i]["title"]."</a></h4>
                            <div class='new-collections-grid1-left simpleCart_shelfItem'>
                                <p><i>$old_price_formated ₫</i> <span class='item_price'>$current_price_formated ₫</span></p>
                            </div>
                        </div>
                    </div>";
            }
            echo '<div class="clearfix"></div>';
            ;
        }

        public function dangky($alert='',$success=''){
            return $this->view('frontend.register.index',[
               "alert" => $alert,
               "success" => $success,
     
            ]);
         }
         public function register(){
            if(!empty($_POST)){
               $fullname = $_POST["fullname"];
               $phone = $_POST["phone"];
               $email = $_POST["email"];
               $address = $_POST["address"];
               $password = $_POST["password"];
               $passwordConfirm = $_POST["passwordConfirm"];
     
               if($password != $passwordConfirm){
                  $this->dangky('Nhập lại mật khẩu không chính xác');
               }
               else if($this->userModel->checkExist("phone",$phone)){
                 $this->dangky('Số điện thoại đã được đăng ký');
               }
               else if($this->userModel->checkExist("email",$email)){
                 $this->dangky('Số điện thoại đã được đăng ký');
               }
               else{
                  $data = [
                    "fullname" => $fullname,
                    "email" => $email,
                    "address" => $address,
                    "phone" => $phone,
                    "password" => $password
                  ];
                  $this->userModel->store($data);
                  $this->dangky('','Đăng ký thành công');
               }
            }
         }
     
         // Đăng nhập tài khoản
         public function dangnhap($alert='',$success=''){
           return $this->view('frontend.login.index',[
              "alert" => $alert,
              "success" => $success,
     
           ]);
        }
        public function login(){
           if(!empty($_POST)){
              $phone = $_POST["phone"];
              $password = $_POST["password"];
              if(!$this->userModel->checkExist("phone",$phone)){
                $this->dangnhap('Số điện thoại không chính xác');
              }
              else if(!$this->userModel->checkExist("password",$password)){
                $this->dangnhap('Mật khẩu không chính xác');
              }
              else{
                 session_start();
                 $_SESSION["phone"] = $phone;
                 header("location: ./index.php?controller=home");
              }
           }
        }
        public function logout(){
            session_start();
            session_unset($_SESSION["phone"]);
            session_unset($_SESSION["cart"]);
            session_destroy();
            header("location: ./index.php?controller=home");
        }
        
    }
?>
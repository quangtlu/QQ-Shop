<?php 
    class UserController extends BaseController{
        private $userModel;
        public function __construct()
        {
            $this->loadModel("UserModel");
            $this->userModel = new UserModel();
    
        }
        public function info(){
           if(isset($_POST["phone"])){
                $phone = $_POST["phone"];
                $userInfo = $this->userModel->findByCondition("phone",$phone);
                echo $userInfo["fullname"];
           }
        }
        public function userInfo(){
            if(isset($_POST["phone"])){
                $phone = $_POST["phone"];
                $userInfo = $this->userModel->findByCondition("phone",$phone);
                echo "
                    <li class='list-group-item list-group-item-action'>Họ tên: <i></i> <b style='color:#D8703F' class='fullname-item'>".$userInfo["fullname"]."</b></li>
                    <li class='list-group-item list-group-item-action'>Số điện thoại: <i></i> <b style='color:#D8703F' class='phone-item'>".$userInfo["phone"]."</b></li>
                    <li class='list-group-item list-group-item-action'>Địa chỉ: <i></i> <b style='color:#D8703F' class='address-item'>".$userInfo["address"]."</b></li>
                ";
           }
        }
    }
?>
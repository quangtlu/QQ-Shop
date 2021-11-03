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
    }
?>
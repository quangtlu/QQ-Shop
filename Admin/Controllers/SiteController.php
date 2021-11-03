<?php
class SiteController extends BaseController{

    private $userModel;
    public function __construct()
    {
        $this->loadModel("UserModel");
        $this->userModel = new UserModel();

    }
    // Đăng nhập tài khoản
    public function index($alert='',$success=''){
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
           $this->index('Số điện thoại không chính xác');
         }
         else if(!$this->userModel->checkExist("password",$password)){
           $this->index('Mật khẩu không chính xác');
         }
         else{
            session_start();
            $_SESSION["admin"] = $phone;
            header("location: ./index.php?controller=home");
         }
      }
   }

}

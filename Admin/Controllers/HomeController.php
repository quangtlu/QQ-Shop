<?php
class HomeController extends BaseController{
    public function index(){
       return $this->view('frontend.home.index');
    }
    public function logout(){
        session_unset("admin");
        header("location: ./index.php?controller=site");
    }
}

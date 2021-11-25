<?php 
    class MailController extends BaseController{

        private $mailModel;

        public function __construct()
        {
            $this->loadModel("MailModel");
            $this->mailModel = new MailModel();
            session_start();

        }
        public function index($alert=''){
            if(isset($_SESSION["phone"])){
                return $this->view("frontend.mail.index",[
                    "alert" => $alert
                ]);
            }
            else{
                header("location: ./index.php?controller=home&action=dangnhap");
            }
        }
        public function send(){
            if(!empty($_POST)){
                $fullname = $_POST["fullname"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $subject_name = $_POST["subject_name"];
                $note = $_POST["note"];
                
                $data = [

                    "fullname" => $fullname,
                    "email" => $email,
                    "phone" => $phone,
                    "subject_name" => $subject_name,
                    "note" => $note,
                ];
                $this->mailModel->store($data);
                $this->index("Gửi phản hồi thành công !");

            }
        }
    }
?>
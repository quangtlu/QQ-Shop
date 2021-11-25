<?php 
    class MailController extends BaseController{

        private $mailModel;

        public function __construct()
        {
            $this->loadModel("MailModel");
            $this->mailModel = new MailModel();

        }
        public function index(){
            $postTotal = $this->mailModel->getNumRecord();
            $postOnePage = 10; 
            $pageTotal = ceil($postTotal / $postOnePage);
            return $this->view('frontend.mail.index',[
                "pageTotal" => $pageTotal,
            ]);
        }
        public function LoadContent(){
            $current_page = isset($_POST['page']) ? $_POST['page'] : 1;
            $postOnePage = 10; // Số bài viết hiển thị trong 1 trang.
            // Khi đã có tổng số bài viết và số bài viết trong một trang ta có thể tính ra được tổng số trang
            $startRecord = ($current_page - 1) * $postOnePage;
            $mails = $this->mailModel->getAllLimit($startRecord, $postOnePage);
            $stt = $startRecord;
            for($i = 0; $i < count($mails); $i++){
                $stt ++;
                echo 
                "
                    <tr class='rem1 animated wow fadeInUp' data-wow-delay='.5s'>
                        <td>$stt</td>
                        <td>".$mails[$i]["fullname"]."</td>
                        <td>".$mails[$i]["phone"]."</td>
                        <td>".$mails[$i]["email"]."</td>
                        <td>".$mails[$i]["subject_name"]."</td>
                        <td><i data-id='".$mails[$i]["id"]."' class='detailBtn far fa-eye'></i></a></td>
                    </tr>
                ";
            }
        }
        public function detail(){
            if(isset($_POST["id"])){
                $mail = $this->mailModel->findById($_POST["id"]);

                echo $mail["note"];
            }
        }
        
    }
    
?>
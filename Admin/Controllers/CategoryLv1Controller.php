<?php 
    class CategoryLv1Controller extends BaseController{

        private $categoryLv1Model;

        public function __construct()
        {
            $this->loadModel("CategoryLv1Model");
            $this->categoryLv1Model = new CategoryLv1Model();

        }
        
        public function index($alert=''){
            $categoriesLv1 = $this->categoryLv1Model->getAll();
            $postTotal = count($categoriesLv1);// Lấy tổng số bài viết.
            $postOnePage = 10; // Số bài viết hiển thị trong 1 trang.
            // Khi đã có tổng số bài viết và số bài viết trong một trang ta có thể tính ra được tổng số trang
            $pageTotal = ceil($postTotal / $postOnePage);
            return $this->view('frontend.categories.Lv1.index',[
                "pageTotal" => $pageTotal,
                "alert" => $alert,
            ]);
            
        }
        public function LoadContent(){
            $current_page = isset($_POST['page']) ? $_POST['page'] : 1;
            $postOnePage = 10; // Số bài viết hiển thị trong 1 trang.
            // Khi đã có tổng số bài viết và số bài viết trong một trang ta có thể tính ra được tổng số trang
            $startRecord = ($current_page - 1) * $postOnePage;
            $data = $this->categoryLv1Model->getAllLimit($startRecord, $postOnePage);

            $stt = $startRecord;
            for($i = 0; $i < count($data); $i++){
                $stt ++;
                echo 
                "
                <tr class='row-content'>
                    <td>$stt</td>
                    <td>".$data[$i]['name']."</td>
                    <td>".$data[$i]['description']."</td>
                    <td><a href='./index.php?controller=categorylv1&action=editCategory&id=".$data[$i]['id']."'><i class='editBtn fas fa-edit'></i></a></td>
                    <td><a href='./index.php?controller=categorylv1&action=delete&id=".$data[$i]['id']."'><i class='removeBtn fas fa-trash-alt'></i></a></td>
                </tr>";
            }
        }

        public function store(){
            if(!empty($_POST)){
                $name = $_POST["name"];
                $description = $_POST["description"];
                $data = [
                            'name' => $name,
                            'description' => $description,
                        ];
                if($this->categoryLv1Model->checkExist("name",$name)){
                    $this->index("Danh mục đã tồn tại");
                }
                else{
                    $this->categoryLv1Model->store($data);
                    header("Location: ./index.php?controller=categoryLv1");
                }

            }
        }
        public function editCategory($alert=''){
            $id = $_GET['id'];
            $category = $this->categoryLv1Model->findById($id);
            return $this->view('frontend.categories.Lv1.edit',
            [
                'id' => $id,
                'alert' => $alert,
                'category' => $category,
            ]);
        }
        public function update(){
            if(isset($_POST) && isset($_GET)){
                $id = $_GET["id"];
                $name = $_POST["name"];
                $description = $_POST["description"];
                $data = [
                            'name' => $name,
                            'description' => $description,
                        ];
                if($this->categoryLv1Model->checkExitsUpdate("name",$name,$id)){
                    $this->editCategory("Tên danh mục cấp 1 đã tồn tại");
                }
                else{
                    $this->categoryLv1Model->updateData($id,$data);
                    header("Location: ./index.php?controller=categoryLv1");
                }
                
            }

        }
        public function delete(){
            $id = $_GET['id'];
            $this->categoryLv1Model->deleteData($id);
            header("Location: ./index.php?controller=categoryLv1");

        }
    }
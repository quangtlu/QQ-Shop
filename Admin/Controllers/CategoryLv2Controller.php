<?php 
    class CategoryLv2Controller extends BaseController{

        private $categoryLv1Model;
        private $categoryLv2Model;

        public function __construct()
        {
            $this->loadModel("CategoryLv1Model");
            $this->categoryLv1Model = new CategoryLv1Model();
            
            $this->loadModel("CategoryLv2Model");
            $this->categoryLv2Model = new CategoryLv2Model();
        }
        
        public function index($alert=''){
            $categoriesLv1 = $this->categoryLv1Model->getAll();
            $postTotal = $this->categoryLv2Model->getNumRecord();
            $postOnePage = 10; 
            $pageTotal = ceil($postTotal / $postOnePage);
            return $this->view('frontend.categories.Lv2.index',[
                "categoriesLv1" => $categoriesLv1,
                "alert" => $alert,
                "pageTotal" => $pageTotal,

            ]);
            
        }
        public function LoadContent(){
            $current_page = isset($_POST['page']) ? $_POST['page'] : 1;
            $postOnePage = 10; 
            $startRecord = ($current_page - 1) * $postOnePage;
            $data = $this->categoryLv2Model->getAllLimit($startRecord, $postOnePage);
            $categoriesLv1 = [];
            foreach($data as $item){
                array_push($categoriesLv1,$this->categoryLv1Model->findById($item["category_lv1ID"]));
            }
            $stt = $startRecord;
            for($i = 0; $i < count($data); $i++){
                $stt ++;
                echo 
                "
                <tr class='row-content'>
                    <td>$stt</td>
                    <td>".$categoriesLv1[$i]['name']."</td>
                    <td>".$data[$i]['name']."</td>
                    <td>".$data[$i]['description']."</td>
                    <td><a href='./index.php?controller=categorylv2&action=editCategory&id=".$data[$i]['id']."'><i class='editBtn fas fa-edit'></i></a></td>
                    <td><a href='./index.php?controller=categorylv2&action=delete&id=".$data[$i]['id']."'><i class='removeBtn fas fa-trash-alt'></i></a></td>
                </tr>";
            }
        }

        public function store(){
            if(!empty($_POST)){
                $name = $_POST["name"];
                $description = $_POST["description"];
                $categoryNameLv1 = $_POST["categoryNameLv1"];
                $category_lv1ID = $this->categoryLv1Model->findByCondition("name",$categoryNameLv1)["id"];

                $data = [
                            'name' => $name,
                            'description' => $description,
                            'category_lv1ID' => $category_lv1ID,
                        ];
                if($this->categoryLv2Model->checkExist("name",$name)){
                    $this->index("Tên danh mục cấp 2 đã tồn tại");
                }
                else{
                    $this->categoryLv2Model->store($data);
                    header("Location: ./index.php?controller=categoryLv2");
                }


            }
        }
        public function editCategory($alert=''){
            $id = $_GET['id'];
            $category = $this->categoryLv2Model->findById($id);
            $categoryNameLv1 = $this->categoryLv1Model->findById($category["category_lv1ID"])["name"];

            $categoriesLv1 = $this->categoryLv1Model->getAll();
            $categoriesLv1Lite = [];
            foreach($categoriesLv1 as $item){
                if($item["name"] != $categoryNameLv1)
                array_push($categoriesLv1Lite,$item);
            }

            return $this->view('frontend.categories.Lv2.edit',
            [
                'id' => $id,
                'alert' => $alert,
                'category' => $category,
                'categoryNameLv1' => $categoryNameLv1,
                'categoriesLv1Lite' => $categoriesLv1Lite,

            ]);
        }
        public function update(){
            if(isset($_POST) && isset($_GET)){
                $id = $_GET["id"];
                $name = $_POST["name"];
                $description = $_POST["description"];
                $categoryNameLv1 = $_POST["categoryNameLv1"];
                $category_lv1ID = $this->categoryLv1Model->findByCondition("name",$categoryNameLv1)["id"];

                $data = [
                            'name' => $name,
                            'description' => $description,
                            'category_lv1ID' => $category_lv1ID,

                        ];
                if($this->categoryLv2Model->checkExitsUpdate("name",$name,$id)){
                    $this->editCategory("Tên danh mục cấp 2 đã tồn tại");
                }
                else{
                    $this->categoryLv2Model->updateData($id,$data);
                    header("Location: ./index.php?controller=categoryLv2");
                }
                
            }

        }
        public function delete(){
            $id = $_GET['id'];
            $this->categoryLv2Model->deleteData($id);
            header("Location: ./index.php?controller=categoryLv2");

        }
    }
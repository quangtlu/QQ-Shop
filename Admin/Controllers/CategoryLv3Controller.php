<?php 
    class CategoryLv3Controller extends BaseController{

        private $categoryLv1Model;
        private $categoryLv2Model;
        private $categoryLv3Model;


        public function __construct()
        {
            $this->loadModel("CategoryLv2Model");
            $this->categoryLv2Model = new CategoryLv2Model();

            $this->loadModel("CategoryLv1Model");
            $this->categoryLv1Model = new CategoryLv1Model();

            $this->loadModel("CategoryLv3Model");
            $this->categoryLv3Model = new CategoryLv3Model();

        }
        
        public function index($alert=''){
            $categoriesLv1 = $this->categoryLv1Model->getAll();
            $categoriesLv2 = $this->categoryLv2Model->getAll();
            $categoriesLv3 = $this->categoryLv3Model->getAll();
            $postTotal = count($categoriesLv3);
            $postOnePage = 10; 
            $pageTotal = ceil($postTotal / $postOnePage);
            return $this->view('frontend.categories.Lv3.index',[
                "pageTotal" => $pageTotal,
                "categoriesLv1" => $categoriesLv1,
                "categoriesLv2" => $categoriesLv2,
                "alert" => $alert,
            ]);
            
        }
        public function LoadContent(){
            $current_page = isset($_POST['page']) ? $_POST['page'] : 1;
            $postOnePage = 10; 
            $startRecord = ($current_page - 1) * $postOnePage;
            $data = $this->categoryLv3Model->getAllLimit($startRecord, $postOnePage);

            $categoriesLv1 = [];
            $categoriesLv2 = [];
            foreach($data as $item){
                array_push($categoriesLv2,$this->categoryLv2Model->findById($item["category_lv2ID"]));
            }
            foreach($categoriesLv2 as $item){
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
                    <td>".$categoriesLv2[$i]['name']."</td>
                    <td>".$data[$i]['name']."</td>
                    <td>".$data[$i]['description']."</td>
                    <td><a href='./index.php?controller=categorylv3&action=editCategory&id=".$data[$i]['id']."'><i class='editBtn fas fa-edit'></i></a></td>
                    <td><a href='./index.php?controller=categorylv3&action=delete&id=".$data[$i]['id']."'><i class='removeBtn fas fa-trash-alt'></i></a></td>
                </tr>";
            }
        }
        public function loadCategoryLv2(){
            if(!empty($_POST)){
                $categoryNameLV1 = $_POST["categoryNameLV1"];
                $categoryLv1ID = $this->categoryLv1Model->findByCondition("name",$categoryNameLV1)["id"];
                $categoriesLv2 = $this->categoryLv2Model->getAll();
                echo "<option value=''></option>"; 
                foreach($categoriesLv2 as $item){
                    if($item["category_lv1ID"] == $categoryLv1ID){
                        echo "
                                <option value='${item["name"]}'>${item["name"]}</option>
                            ";
                    }
            
                }
            }
        }
        public function loadCategoryLv3(){
            if(!empty($_POST)){
                $categoryNameLV2 = $_POST["categoryNameLV2"];
                $categoryLv2ID = $this->categoryLv2Model->findByCondition("name",$categoryNameLV2)["id"];

                $categoriesLv3 = $this->categoryLv3Model->getAll();

                foreach($categoriesLv3 as $item){
                    if($item["category_lv2ID"] == $categoryLv2ID){
                        echo "
                                <option value='${item["name"]}'>${item["name"]}</option>
                            ";
                    }
                }
            }
        }
        public function store(){
            if(!empty($_POST)){
                $name = $_POST["name"];
                $description = $_POST["description"];
                $categoryNameLv1 = $_POST["categoryNameLv1"];
                $categoryNameLv2 = $_POST["categoryNameLv2"];
                $category_lv1ID = $this->categoryLv1Model->findByCondition("name",$categoryNameLv1)["id"];
                $category_lv2ID = $this->categoryLv2Model->findByCondition("name",$categoryNameLv2)["id"];

                $data = [
                            'name' => $name,
                            'description' => $description,
                            'category_lv2ID' => $category_lv2ID,
                        ];

                // Kiểm tra tồn tại danh mục cấp 2 có category_lv1ID và name trùng với POST
                if(count($this->categoryLv2Model->findByTwoCondition("category_lv1ID",$category_lv1ID,"name",$categoryNameLv2))>0){
                    if(count($this->categoryLv3Model->findByTwoCondition("category_lv2ID",$category_lv2ID,"name",$name))>0){
                        $this->index("Tên danh mục cấp 3 đã tồn tại");
                    }
                    else{
                        $this->categoryLv3Model->store($data);
                        header("Location: ./index.php?controller=categoryLv3");
                    }
                }
                else{
                    $this->index("Danh mục cấp 1 và cấp 2 không phù hợp");
                }
                
            }
        }
        public function editCategory($alert=''){
            $id = $_GET['id'];
            $category = $this->categoryLv3Model->findById($id);
            $category2 = $this->categoryLv2Model->findById($category["category_lv2ID"]);

            $categoryNameLv2 = $category2["name"];
            
            $categoriesLv2 = $this->categoryLv2Model->getAll();
            $categoriesLv2Lite = [];
            foreach($categoriesLv2 as $item){
                if($item["name"] != $categoryNameLv2)
                array_push($categoriesLv2Lite,$item);
            }

            $categoryIdlv1 = $category2["category_lv1ID"];
            $categoryNameLv1 = $this->categoryLv1Model->findById($categoryIdlv1)["name"];
            $categoriesLv1 = $this->categoryLv1Model->getAll();
            $categoriesLv1Lite = [];
            foreach($categoriesLv1 as $item){
                if($item["name"] != $categoryNameLv1)
                array_push($categoriesLv1Lite,$item);
            }
            return $this->view('frontend.categories.Lv3.edit',
            [
                'id' => $id,
                'alert' => $alert,
                'category' => $category,
                'categoryNameLv2' => $categoryNameLv2,
                'categoriesLv2Lite' => $categoriesLv2Lite,
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
                $categoryNameLv2 = $_POST["categoryNameLv2"];
                $category_lv1ID = $this->categoryLv1Model->findByCondition("name",$categoryNameLv1)["id"];
                $category_lv2ID = $this->categoryLv2Model->findByCondition("name",$categoryNameLv2)["id"];

                $data = [
                            'name' => $name,
                            'description' => $description,
                            'category_lv2ID' => $category_lv2ID,
                        ];

                // Kiểm tra tồn tại danh mục cấp 2 có category_lv1ID và name trùng với POST
                if(count($this->categoryLv2Model->findByTwoCondition("category_lv1ID",$category_lv1ID,"name",$categoryNameLv2))>0){
                    if($this->categoryLv3Model->checkExitsUpdate2Value("name",$name,"category_lv2ID",$category_lv2ID,$id)){
                        $this->editCategory("Tên danh mục cấp 3 đã tồn tại");
                    }
                    else{
                        $this->categoryLv3Model->updateData($id,$data);
                        header("Location: ./index.php?controller=categoryLv3");
                    }
                }
                else{
                    $this->editCategory("Danh mục cấp 1 và cấp 2 không phù hợp");
                }
             
                
            }

        }
        public function delete(){
            $id = $_GET['id'];
            $this->categoryLv3Model->deleteData($id);
            header("Location: ./index.php?controller=categoryLv3");

        }
    }
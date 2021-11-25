<?php 
    class ProductController extends BaseController{

        private $productModel;
        private $categoryLv3Model;
        private $categoryLv2Model;
        private $categoryLv1Model;

        public function __construct()
        {
            $this->loadModel("ProductModel");
            $this->productModel = new ProductModel();

            $this->loadModel("CategoryLv3Model");
            $this->categoryLv3Model = new CategoryLv3Model();

            $this->loadModel("CategoryLv1Model");
            $this->categoryLv1Model = new CategoryLv1Model();

            $this->loadModel("CategoryLv2Model");
            $this->categoryLv2Model = new CategoryLv2Model();
        }
        
        public function index($alert=''){
            $postTotal = $this->productModel->getNumRecord();
            $postOnePage = 5; 
            $pageTotal = ceil($postTotal / $postOnePage);
            $categoriesLv1 = $this->categoryLv1Model->getAll();
            
            return $this->view('frontend.products.index',[
                "pageTotal" => $pageTotal,
                "alert" => $alert,
                "categoriesLv1" => $categoriesLv1,

            ]);
            

            
        }
        public function LoadContent(){
            $current_page = isset($_POST['page']) ? $_POST['page'] : 1;
            $postOnePage = 5; // Số bài viết hiển thị trong 1 trang.
            // Khi đã có tổng số bài viết và số bài viết trong một trang ta có thể tính ra được tổng số trang
            $startRecord = ($current_page - 1) * $postOnePage;
            $data = $this->productModel->getAllLimit($startRecord, $postOnePage);
            $categoryName = [];
            foreach($data as $item){
                array_push($categoryName,$this->categoryLv3Model->findById($item["category_lv3ID"]));
            }
            
            $stt = $startRecord;
            for($i = 0; $i < count($data); $i++){
                $url_image = $this->fixUrl($data[$i]['thumbnail']);
                $price_formated = number_format($data[$i]['price'], 0, '', ',');
                $stt ++;
                echo 
                "
                <tr class='row-content'>
                    <td>$stt</td>
                    <td><img class='thumbnail-img' src='".$url_image."' alt='Ảnh ".$data[$i]["title"]."'></td>
                    <td>".$data[$i]['title']."</td>
                    <td>".$categoryName[$i]['name']."</td>
                    <td>".$price_formated."₫</td>
                    <td>".$data[$i]['discount']."%</td>
                    <td><a href='./index.php?controller=product&action=detail&id=".$data[$i]['id']."'><i class='editBtn far fa-eye'></i></a></td>
                    <td><a href='./index.php?controller=product&action=editProduct&id=".$data[$i]['id']."'><i class='editBtn fas fa-edit'></i></a></td>
                    <td><a href='./index.php?controller=product&action=delete&id=".$data[$i]['id']."'><i class='removeBtn fas fa-trash-alt'></i></a></td>
                </tr>";
            }
        }
        
        public function store(){
            if(!empty($_POST)){
                $title = $_POST["title"];
                $price = $_POST["price"];
                $discount = $_POST["discount"];

                $categoryNameLV2 = $_POST["categoryNameLv2"];
                $categoryNameLV2ID = $this->categoryLv2Model->findByCondition("name",$categoryNameLV2)['id'];
                $categoryNameLV3 = $_POST["categoryNameLv3"];
                $category_lv3ID = $this->categoryLv3Model->findByTwoCondition("name",$categoryNameLV3,"category_lv2ID",$categoryNameLV2ID)[0]["id"];

                $thumbnail = $this->moveFile("thumbnail");

                $description = $_POST["description"];

                $details = $this->moveMutilFile("details");

                $data = [
                            'title' => $title,
                            'price' => $price,
                            'category_lv3ID' => $category_lv3ID,
                            'thumbnail' => $thumbnail,
                            'gallery' => $details,
                            'discount' => $discount,
                            'description' => $description,
                        ];
                if($this->productModel->checkExist("title",$title)){
                    $this->index("Tên sản phẩm đã tồn tại");
                }
                else{
                    $this->productModel->store($data);
                    header("Location: ./index.php?controller=product");
                }
            }
            else{
                header("Location: ./index.php?controller=product");
            }
        }
        public function editProduct($alert=''){
            $id = $_GET['id'];
            $product = $this->productModel->findById($id);
            $categoriesLv1 = $this->categoryLv1Model->getAll();
            return $this->view('frontend.products.edit',
            [
                'id' => $id,
                'alert' => $alert,
                'product' => $product,
                'categoriesLv1' => $categoriesLv1,

            ]);
        }
        public function update(){
            if(!empty($_POST)){
                $id = $_GET["id"];
                $title = $_POST["title"];
                $price = $_POST["price"];
                $discount = $_POST["discount"];
                
                $categoryNameLV2 = $_POST["categoryNameLv2"];
                $categoryNameLV2ID = $this->categoryLv2Model->findByCondition("name",$categoryNameLV2)['id'];
                $categoryNameLV3 = $_POST["categoryNameLv3"];
                $category_lv3ID = $this->categoryLv3Model->findByTwoCondition("name",$categoryNameLV3,"category_lv2ID",$categoryNameLV2ID)[0]["id"];


                $description = $_POST["description"];

                $thumbnail = $this->moveFile("thumbnail");
                $galleries = $this->moveMutilFile("galleries");

                $data = [
                    'title' => $title,
                    'price' => $price,
                    'category_lv3ID' => $category_lv3ID,
                    'discount' => $discount,
                    'description' => $description,
                ];
                if($thumbnail != ''){
                    $data["thumbnail"] = $thumbnail;
                }
                if($galleries != ''){
                    $data["gallery"] = $galleries;
                }
                
                if($this->productModel->checkExitsUpdate("title",$title,$id)){
                    $this->editProduct("Tên sản phẩm đã tồn tại");
                }
                else{
                    $this->productModel->updateData($id,$data);
                    header("Location: ./index.php?controller=product");
                }

            }

        }
        public function detail(){
            $id = $_GET["id"];
            $product = $this->productModel->findById($id);
            $categoryLv3 = $this->categoryLv3Model->findById($product["category_lv3ID"]);
            $categoryLv2 = $this->categoryLv2Model->findById($categoryLv3["category_lv2ID"]);
            $categoryLv1 = $this->categoryLv1Model->findById($categoryLv2["category_lv1ID"]);

            $categoryNameLv1 = $categoryLv1["name"];
            $categoryNameLv2 = $categoryLv2["name"];
            $categoryNameLv3 = $categoryLv3["name"];
            if($product["gallery"] != null){
                $galleries = explode(",",$product["gallery"]);
            }
            else{
                $galleries = explode(",",$product["thumbnail"]);
            }
            $details = [];
            foreach($galleries as $item){
                array_push($details,$this->fixUrl($item));
            }
            $thumbnail = $this->fixUrl($product["thumbnail"]);
            return $this->view('frontend.products.detail',
            [
                'product' => $product,
                'categoryNameLv1' => $categoryNameLv1,
                'categoryNameLv2' => $categoryNameLv2,
                'categoryNameLv3' => $categoryNameLv3,
                'details' => $details,
                'thumbnail' => $thumbnail,

            ]);


        }
        public function delete(){
            $id = $_GET['id'];
            $this->productModel->deleteData($id);
            header("Location: ./index.php?controller=product");

        }
    }
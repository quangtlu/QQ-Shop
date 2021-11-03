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
        // list product by category
        public function index(){
            $id = $_GET["id"];
            $categoryLv3 = $this->categoryLv3Model->findById($id);
            $categoryLv2 = $this->categoryLv2Model->findById($categoryLv3["category_lv2ID"]);
            $categoryLv1 = $this->categoryLv1Model->findById($categoryLv2["category_lv1ID"]);

            $categoryNameLv1 = $categoryLv1["name"];
            $categoryNameLv2 = $categoryLv2["name"];
            $categoryNameLv3 = $categoryLv3["name"];
            $totalRecord = count($this->productModel->findAllByCondition('category_lv3ID',$id));
            $productOnePage = 12;
            $pageTotal = ceil($totalRecord/$productOnePage);
            $this->view("frontend.products.ListByCategory",[
                "pageTotal" => $pageTotal,
                'categoryNameLv1' => $categoryNameLv1,
                'categoryNameLv2' => $categoryNameLv2,
                'categoryNameLv3' => $categoryNameLv3,
            ]);
        }
        public function productBycategory(){
            $id = $_POST["id_cate"];
            $current_page = isset($_POST['page']) ? $_POST['page'] : 1;
            $productOnePage = 12; // Số sản phẩm trên 1 trang
            $startRecord = ($current_page - 1) * $productOnePage;
            // Lấy ra limit sản phẩm có cùng danh mục cấp 3
            $data = $this->productModel->findAllByConditionLimit("category_lv3ID",$id,$startRecord, $productOnePage);
            for($i = 0; $i < count($data); $i++){
                    $old_price_formated = number_format($data[$i]["price"], 0, '', ',');
                    $current_price = $data[$i]["discount"] !=0 ? ($data[$i]["price"] - $data[$i]["price"]*($data[$i]["discount"]/100))  :  $data[$i]["price"];
                    $current_price_formated = number_format($current_price, 0, '', ',');
                    $img_path = $this->fixUrl($data[$i]["thumbnail"],"./");
                    echo 
                    "
                    <div class='col-md-3 new-collections-grid mt-3'>
                        <div class='new-collections-grid1 animated wow fadeInUp' data-wow-delay='.5s'>
                            <div class='new-collections-grid1-image'>
                                <a href='./index.php?controller=product&action=detail&id=".$data[$i]["id"]."' class='product-image'><img src='".$img_path."' alt=' '
                                        class='img-responsive' /></a>
                                <div class='new-collections-grid1-image-pos'>
                                    <a href='./index.php?controller=product&action=detail&id=".$data[$i]["id"]."'>Xem chi tiết</a>
                                </div>
                                <div class='new-collections-grid1-right'>
                                    <div class='rating'>
                                        <div class='rating-left'>
                                            <!-- Ảnh icon sao rating -->
                                            <img src='./Home/Views/frontend/public/web/images/2.png' alt=' ' class='img-responsive' />
                                        </div>
                                        <div class='rating-left'>
                                            <img src='./Home/Views/frontend/public/web/images/2.png' alt=' ' class='img-responsive' />
                                        </div>
                                        <div class='rating-left'>
                                            <img src='./Home/Views/frontend/public/web/images/2.png' alt=' ' class='img-responsive' />
                                        </div>
                                        <div class='rating-left'>
                                            <img src='./Home/Views/frontend/public/web/images/2.png' alt=' ' class='img-responsive' />
                                        </div>
                                        <div class='rating-left'>
                                            <img src='./Home/Views/frontend/public/web/images/1.png' alt=' ' class='img-responsive' />
                                        </div>
                                        <div class='clearfix'> </div>
                                    </div>
                                </div>
                            </div>
                            <h4><a>".$data[$i]["title"]."</a></h4>
                            <div class='new-collections-grid1-left simpleCart_shelfItem'>
                                <p><i>$old_price_formated ₫</i> <span class='item_price'>$current_price_formated ₫</span></p>
                                <p><a class='item_add' href='#'>add to cart </a></p>
                            </div>
                        </div>
                    </div>";
            }
            echo '<div class="clearfix"></div>';
            ;
        }
        public function detail(){
            if(isset($_GET["id"])){

                $id = $_GET["id"];
                $product = $this->productModel->findById($id);
                $categoryLv3 = $this->categoryLv3Model->findById($product["category_lv3ID"]);
                $categoryLv2 = $this->categoryLv2Model->findById($categoryLv3["category_lv2ID"]);
                $categoryLv1 = $this->categoryLv1Model->findById($categoryLv2["category_lv1ID"]);
    
                $categoryNameLv1 = $categoryLv1["name"];
                $categoryNameLv2 = $categoryLv2["name"];
                $categoryNameLv3 = $categoryLv3["name"];
    
    
                $productOnePage = 4;
                $totalRecordRealte = count($this->productModel->findAllByCondition("category_lv3ID",$product["category_lv3ID"]));
                $pageTotal = ceil($totalRecordRealte/$productOnePage);
    
                if($product["gallery"] != null){
                    $galleries = explode(",",$product["gallery"]);
                }
                else{
                    $galleries = explode(",",$product["thumbnail"]);
                }
                $details = [];
                foreach($galleries as $item){
                    array_push($details,$this->fixUrl($item,"./"));
                }
                $thumbnail = $this->fixUrl($product["thumbnail"],"./");
    
                $old_price_formated = number_format($product["price"], 0, '', ',');
                $current_price = $product["discount"] !=0 ? ($product["price"] - $product["price"]*($product["discount"]/100)) :  $product["price"];
                $current_price_formated = number_format($current_price, 0, '', ',');
    
                return $this->view('frontend.products.detail',
                [
                    'product' => $product,
                    'categoryNameLv1' => $categoryNameLv1,
                    'categoryNameLv2' => $categoryNameLv2,
                    'categoryNameLv3' => $categoryNameLv3,
                    'details' => $details,
                    'thumbnail' => $thumbnail,
                    'pageTotal' => $pageTotal,
                    'old_price_formated' => $old_price_formated,
                    'current_price_formated' => $current_price_formated,
                ]);
            }

        }

        public function productRelated(){
                $id = $_POST["id_product"];
                $product = $this->productModel->findById($id);
                $current_page = isset($_POST['page']) ? $_POST['page'] : 1;
                $productOnePage = 4; // Số sản phẩm trên 1 trang
                $startRecord = ($current_page - 1) * $productOnePage;
                // Lấy ra limit sản phẩm có cùng danh mục cấp 3
                $data = $this->productModel->findAllByConditionLimit("category_lv3ID",$product["category_lv3ID"],$startRecord, $productOnePage);
    
                for($i = 0; $i < count($data); $i++){
                    // Không hiển thị sản phẩm hiện tại
                        $old_price_formated = number_format($data[$i]["price"], 0, '', ',');
                        $current_price = $data[$i]["discount"] !=0 ? ($data[$i]["price"] - $data[$i]["price"]*($data[$i]["discount"]/100))  :  $data[$i]["price"];
                        $current_price_formated = number_format($current_price, 0, '', ',');
                        $img_path = $this->fixUrl($data[$i]["thumbnail"],"./");
                        echo 
                        "
                        <div class='col-md-3 new-collections-grid mt-3'>
                            <div class='new-collections-grid1 animated wow fadeInUp' data-wow-delay='.5s'>
                                <div class='new-collections-grid1-image'>
                                    <a href='./index.php?controller=product&action=detail&id=".$data[$i]["id"]."' class='product-image'><img src='".$img_path."' alt=' '
                                            class='img-responsive' /></a>
                                    <div class='new-collections-grid1-image-pos'>
                                        <a href='./index.php?controller=product&action=detail&id=".$data[$i]["id"]."'>Xem chi tiết</a>
                                    </div>
                                    <div class='new-collections-grid1-right'>
                                        <div class='rating'>
                                            <div class='rating-left'>
                                                <!-- Ảnh icon sao rating -->
                                                <img src='./Home/Views/frontend/public/web/images/2.png' alt=' ' class='img-responsive' />
                                            </div>
                                            <div class='rating-left'>
                                                <img src='./Home/Views/frontend/public/web/images/2.png' alt=' ' class='img-responsive' />
                                            </div>
                                            <div class='rating-left'>
                                                <img src='./Home/Views/frontend/public/web/images/2.png' alt=' ' class='img-responsive' />
                                            </div>
                                            <div class='rating-left'>
                                                <img src='./Home/Views/frontend/public/web/images/2.png' alt=' ' class='img-responsive' />
                                            </div>
                                            <div class='rating-left'>
                                                <img src='./Home/Views/frontend/public/web/images/1.png' alt=' ' class='img-responsive' />
                                            </div>
                                            <div class='clearfix'> </div>
                                        </div>
                                    </div>
                                </div>
                                <h4><a>".$data[$i]["title"]."</a></h4>
                                <div class='new-collections-grid1-left simpleCart_shelfItem'>
                                    <p><i>$old_price_formated ₫</i> <span class='item_price'>$current_price_formated ₫</span></p>
                                </div>
                            </div>
                        </div>";
                    
                }
                echo '<div class="clearfix"></div>';
                ;
        }
        
    }
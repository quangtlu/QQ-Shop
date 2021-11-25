<?php 
    class CategoryController extends BaseController{

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
        // Danh mục sản phẩm trên Nav
        public function index(){
            // load danh mục cấp 1
            $categoriesLv1 = $this->categoryLv1Model->getAll();

            for($i = 0; $i < count($categoriesLv1); $i++){
                echo"
                <li class='dropdown'>
                    <a href='#' class='categorylv1-link dropdown-toggles' data-toggle='dropdown'>".$categoriesLv1[$i]["name"]."<b class='carets'></b></a>
                    <ul class='dropdown-menu multi-column columns-3'>
                        <div class='row'>";
                        // Lấy tất cả danh mục cấp 2 trong từng danh mục cấp 1
                        $categoriesLv2 = $this->categoryLv2Model->findAllByCondition("category_lv1ID",$categoriesLv1[$i]["id"]);
                        for($j = 0; $j < count($categoriesLv2); $j++){
                            echo"
                                <div class='col-sm-4'>
                                    <ul class='multi-column-dropdown'>
                                        <h6>".$categoriesLv2[$j]["name"]."</h6>";
                                    // Lấy tất cả danh mục cấp 3 trong từng danh mục cấp 2
                                    $categoriesLv3 = $this->categoryLv3Model->findAllByCondition("category_lv2ID",$categoriesLv2[$j]["id"]);
                                    for($k = 0; $k < count($categoriesLv3); $k++){
                                        echo "<li ><a class='categorylv3-link' href='./index.php?controller=product&action=index&id=".$categoriesLv3[$k]["id"]."'>".$categoriesLv3[$k]["name"]."</a></li>";
                                    }
                                        
                             echo "</ul>
                                </div>
                                ";
                        }
                echo"
                <div class='clearfix'></div>
                            </div>
                    </ul>
                </li>
                ";
                
            }
            echo " <li><a href='./index.php?controller=mail'>PHẢN HỒI</a></li>";
            
        }
    }
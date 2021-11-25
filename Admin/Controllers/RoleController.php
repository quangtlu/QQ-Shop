<?php 
    class RoleController extends BaseController{
        private $roleModel;
        public function __construct()
        {
            $this->loadModel("RoleModel");
            $this->roleModel = new RoleModel();

        }
        
        public function index(){
            $postTotal = $this->roleModel->getNumRecord();
            $postOnePage = 10; 
            $pageTotal = ceil($postTotal / $postOnePage);
            return $this->view('frontend.role.index',[
                "pageTotal" => $pageTotal,
            ]);
            
        }
        public function LoadContent(){
            $current_page = isset($_POST['page']) ? $_POST['page'] : 1;
            $postOnePage = 10; 
            $startRecord = ($current_page - 1) * $postOnePage;
            $roles = $this->roleModel->getAllLimit($startRecord, $postOnePage);
            $stt = $startRecord;
            for($i = 0; $i < count($roles); $i++){
                $stt ++;
                echo 
                "
                    <tr class='row-table'>
                        <td>$stt</td>
                        <td>".$roles[$i]["name"]."</td>
                        <td>".$roles[$i]["description"]."</td>
                        <td><a href='./index.php?controller=user&action=editUser&id=".$roles[$i]["id"]."'><i class='editBtn fas fa-edit'></i></a></td>
                        <td><a href='./index.php?controller=user&action=delete&id=".$roles[$i]["id"]."'><i class='removeBtn fas fa-trash-alt'></i></a></td>
                    </tr>
                ";
            }
        }
        public function addRole($alert=''){
            return $this->view('frontend.role.add',[
                'alert' => $alert
            ]);
        }

        public function store(){
            if(!empty($_POST)){
                $rolename = $_POST["rolename"];
                if (!isset($_POST["chucnang"])) {
                    $description = 'Người dùng';
                } else {
                    $chucnangArr = $_POST["chucnang"];
                    $description = implode(", ", $chucnangArr);
                }
                $data = [
                            'name' => $rolename,
                            'description' => $description,
                        ];
                if($this->roleModel->checkExist("name",$rolename)){
                    $alert = "Tên nhóm quyền đã tồn tại";
                    $this->addRole($alert);
                }
                else{
                    $this->roleModel->store($data);
                    header("Location: ./index.php?controller=role");
                }
                
            }
        }
        public function editRole($alert=''){
            $id = $_GET['id'];
            $roles = $this->roleModel->findById($id);
            return $this->view('frontend.role.edit',
            [
                'roles' => $roles,
                'id' => $id,
                'alert' => $alert,
            ]);
        }
        public function update(){
            if(isset($_POST) && isset($_GET)){
                $id = $_GET["id"];
                $rolename = $_POST["rolename"];
                if (!isset($_POST["chucnang"])) {
                    $description = 'Người dùng';
                } else {
                    $chucnangArr = $_POST["chucnang"];
                    $description = implode(", ", $chucnangArr);
                }
                $data = [
                            'name' => $rolename,
                            'description' => $description,
                        ];
                if($this->roleModel->checkExitsUpdate("name",$rolename,$id)){
                    $alert = "Tên nhóm quyền đã tồn tại";
                    $this->editRole($alert);
                }
                else{
                    $this->roleModel->updateData($id,$data);
                    header("Location: ./index.php?controller=role");
                }
                
            }

        }
        public function delete(){
            $id = $_GET['id'];
            $this->roleModel->deleteData($id);
            header("Location: ./index.php?controller=role");

        }
    } 
?>
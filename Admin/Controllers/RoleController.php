<?php 
    class RoleController extends BaseController{
        private $roleModel;
        public function __construct()
        {
            $this->loadModel("RoleModel");
            $this->roleModel = new RoleModel();

        }
        
        public function index(){
            $roles = $this->roleModel->getAll();
            return $this->view('frontend.role.index',[
                "roles" => $roles,
            ]);
            
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
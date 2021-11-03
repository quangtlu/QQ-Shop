<?php 
    class UserController extends BaseController{
        private $userModel;
        private $roleModel;

        public function __construct()
        {
            $this->loadModel("UserModel");
            $this->userModel = new UserModel();

            $this->loadModel("RoleModel");
            $this->roleModel = new RoleModel();

        }
        
        public function index(){
            $users = $this->userModel->getAll();
            $roles = [];
            foreach($users as $item){
                array_push($roles,$this->roleModel->findById($item["role_id"]));
            }
            return $this->view('frontend.user.index',[
                "users" => $users,
                "roles" => $roles,
            ]);
            
        }
        public function adduser($alert=''){
            $roles = $this->roleModel->getAll();
            return $this->view('frontend.user.add',[
                'alert' => $alert,
                'roles' => $roles,

            ]);
        }

        public function store(){
            if(!empty($_POST)){
                $fullname = $_POST["fullname"];
                $email = $_POST["email"];
                $address = $_POST["address"];
                $phone = $_POST["phone"];
                $password = $_POST["password"];
                $roleName = $_POST["roleName"];
                $roleID = $this->roleModel->findByCondition("name",$roleName)["id"];
                $data = [
                            'fullname' => $fullname,
                            'email' => $email,
                            'address' => $address,
                            'phone' => $phone,
                            'password' => $password,
                            'role_id' => $roleID,

                        ];
                if($this->userModel->checkExist("email",$email)){
                    $alert = "Email đã được đăng ký";
                    $this->adduser($alert);
                }
                else if($this->userModel->checkExist("phone",$phone)){
                    $alert = "Số điện thoại` đã được đăng ký";
                    $this->adduser($alert);
                }
                else{
                    $this->userModel->store($data);
                    header("Location: ./index.php?controller=user");
                }
                

                
            }
        }
        public function editUser($alert=''){
            $id = $_GET['id'];
            $users = $this->userModel->findById($id);
            $roles = $this->roleModel->getAll();

            return $this->view('frontend.user.edit',
            [
                'users' => $users,
                'roles' => $roles,
                'id' => $id,
                'alert' => $alert,
            ]);
        }
        public function update(){
            if(isset($_POST) && isset($_GET)){
                $id = $_GET["id"];
                $fullname = $_POST["fullname"];
                $email = $_POST["email"];
                $address = $_POST["address"];
                $phone = $_POST["phone"];
                $password = $_POST["password"];
                $roleName = $_POST["roleName"];
                $roleID = $this->roleModel->findByCondition("name",$roleName)["id"];
                $data = [
                            'fullname' => $fullname,
                            'email' => $email,
                            'address' => $address,
                            'phone' => $phone,
                            'password' => $password,
                            'role_id' => $roleID,

                        ];
                if($this->userModel->checkExitsUpdate("email",$email,$id)){
                    $alert = "Email đã được đăng ký";
                    $this->edituser($alert);
                }
                else if($this->userModel->checkExitsUpdate("phone",$phone,$id)){
                    $alert = "Số điện thoại đã được đăng ký";
                    $this->edituser($alert);
                }
                else{
                    $this->userModel->updateData($id,$data);
                    header("Location: ./index.php?controller=user");
                }
                
            }

        }
        public function delete(){
            $id = $_GET['id'];
            $this->userModel->deleteData($id);
            header("Location: ./index.php?controller=user");

        }
    } 
?>
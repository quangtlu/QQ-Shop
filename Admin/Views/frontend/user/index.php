<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý tài khoản người dùng</title>
    <?php $this->view('frontend.public.base')?>

</head>
<body>
<?php $this->view('frontend.public.header')?>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
            <th scope="col">STT</th>
            <th scope="col">Họ tên</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Email</th>
            <th scope="col">Địa chỉ</th>
            <th scope="col">Nhóm quyền</th>
            <th scope="col">sửa</th>
            <th scope="col">Xóa</th>
            </tr>
        </thead>
        <tbody class="row-table">
            <?php 
                for($i = 0; $i < count($users); $i++){
                    $stt = $i + 1;
                    echo 
                    "
                        <td>$stt</td>
                        <td>".$users[$i]["fullname"]."</td>
                        <td>".$users[$i]["phone"]."</td>
                        <td>".$users[$i]["email"]."</td>
                        <td>".$users[$i]["address"]."</td>
                        <td>".$roles[$i]["name"]."</td>
                        <td><a href='./index.php?controller=user&action=editUser&id=".$users[$i]["id"]."'><i class='editBtn fas fa-edit'></i></a></td>
                        <td><a href='./index.php?controller=user&action=delete&id=".$users[$i]["id"]."'><i class='removeBtn fas fa-trash-alt'></i></a></td>
                    </tr>";
                }
            ?>
        </tbody>
        </table>
        <a href="./index.php?controller=user&action=adduser">
        <button type="button" class="mt-2 btn createBtn btn-primary">Thêm mới</button>
        </a>
<?php $this->view('frontend.public.footer') ?>
</body>
</html>

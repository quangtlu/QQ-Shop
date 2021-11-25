<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhóm quyền</title>
    <?php $this->view('frontend.public.base')?>

</head>

<body>
    <?php $this->view('frontend.public.header')?>
    <div style="min-height: 550px;">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên nhóm quyền</th>
                <th scope="col">Chức năng</th>
                <th scope="col">sửa</th>
                <th scope="col">Xóa</th>
            </tr>
        </thead>
        <tbody class="row-table"></tbody>
    </table>
    </div>
    <nav style="margin:10px" aria-label="...">
        <ul class="pagination ml-2">
            <?php for ($i = 1; $i <= $pageTotal; $i++): ?>
            <li class="page-item">
                <a class="page-link"><?= $i; ?></a>
            </li>
            <?php endfor; ?>
        </ul>
    </nav>
    <a href="./index.php?controller=role&action=addRole">
        <button type="button" class="mt-2 btn createBtn btn-primary">Thêm mới</button>
    </a>
    <?php $this->view('frontend.public.footer') ?>
    <?php $this->view('frontend.public.js.boostrapJS') ?>

    <script>
    $(document).ready(function() {
        // Dữ liệu khi khởi tạo trang, mặc định trang 1
        $("li.page-item").first().addClass('active')
        $.ajax({
            url: './index.php?controller=role&action=LoadContent',
            dataType: 'html',
            success: function(data) {
                $('.row-table').html(data);
            }
        });

        // Dữ liệu khi click trang
        $('a.page-link').on('click', function() {
            var _p = $(this).text();
            $.ajax({
                url: './index.php?controller=role&action=LoadContent',
                data: {
                    page: _p
                },
                type: 'POST',
                dataType: 'html',
                success: function(data) {
                    $('.row-table').html(data);
                }
            });
        });

        $(".page-item").click(function() {

            if ($(this).hasClass("active")) {
                $(".page-item").removeClass("active");
            } else {
                $(".page-item").removeClass("active");
                $(this).addClass("active");
            }
        });

    });
    </script>
</body>

</html>
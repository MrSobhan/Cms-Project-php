<?php
include_once('../layout/connect.php');

if(isset($_POST['exit'])){
    $_SESSION['login'] = 'false';
    redirect('panel/login.php');
}


global $pdo;

$query = "SELECT * FROM `users`";
$statusment = $pdo->prepare($query);
$statusment->execute();
$users = $statusment->fetchAll();


try {
    if (isset($_POST['sub'])) {
        $name_user = htmlspecialchars($_POST['name_user']);
        $img_user = $_FILES['img_user']['name'];
        $pass_user = htmlspecialchars($_POST['pass_user']);
        $email_user = htmlspecialchars($_POST['email_user']);
        $type_user = $_POST['type_user'];
        $imageFileType = pathinfo($img_user, PATHINFO_EXTENSION);


        if ($img_user != '') {
            // Check file size
            if ($_FILES["img_user"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                exit;
            }

            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            ) {
                echo "Sorry, only JPG, JPEG & PNG files are allowed.";
                exit;
            }

            // uploaded_file
            move_uploaded_file($_FILES['img_user']['tmp_name'], '../ProfileUsers/' . $img_user);
        }


        $queryinsert = "INSERT INTO `users`(`name`, `img`, `password`, `email`, `type` , `date_create`) VALUES (?,?,?,?,? , NOW())";
        $statusment1 = $pdo->prepare($queryinsert);
        $statusment1->execute([$name_user, $img_user, $pass_user, $email_user, $type_user]);

        redirect('users/');
    }
} catch (PDOException $e) {
    echo 'Error : '  . $e->getMessage();
}


?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.rtl.min.css" integrity="sha384-beJoAY4VI2Q+5IPXjI207/ntOuaz06QYCdpWfWRv4lSFDyUSqsM0W+wiAMr2I185" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../css/main.css">

    <title>webprog.io</title>
</head>

<body>

    <section x-data="toggleSidebar">
        <?php include_once('../layout/menu.php'); ?>

        <section class="main" :class="open || 'active'">
            <?php include_once('../layout/header.php'); ?>

            <div class="content p-2 p-lg-4">
                <div class="container-fluid">
                    <div class="row">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="./index.html">داشبورد</a></li>
                                <li class="breadcrumb-item active" aria-current="page">لیست کاربران</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="card">
                            <div class="card-header text-end">
                                <button class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="bi bi-funnel-fill"></i>
                                    ایجاد
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>نام کاربر</th>
                                                <th>گذرواژه</th>
                                                <th>ایمیل</th>
                                                <th>نوع کاربر</th>
                                                <th>عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php foreach ($users as $user) { ?>
                                                <tr>
                                                    <td><?= $user->id ?></td>
                                                    <td class="text-muted"><img src="<?= '../ProfileUsers/' . $user->img ?>" alt="not" class="img-fluid rounded-pill me-2" width="9%"><?= $user->name ?></td>
                                                    <td class="text-muted"><?= $user->password ?></td>
                                                    <td class="text-muted"><?= $user->email ?></td>
                                                    <td class="text-muted"><?= $user->type ?></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-light-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                عملیات
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li><a class="dropdown-item" href="./edit.php?id=<?= $user->id ?>">ویرایش</a></li>
                                                                <li><a class="dropdown-item" href="./delete.php?id=<?= $user->id ?>">حذف</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ایجاد کاربران</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <center><img src="../images/1.jpg" alt="" class="img-fluid w-50 rounded-pill img-js"></center>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">پروفایل کاربر</label>
                            <input type="file" name="img_user" class="form-control upload-js">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail2" class="form-label">نام کاربر</label>
                            <input type="text" name="name_user" class="form-control">
                        </div>

                        <div class="mb-5">
                            <label for="exampleInputEmail2" class="form-label">گذرواژه</label>
                            <input type="text" name="pass_user" class="form-control">
                        </div>

                        <select name="type_user" class="form-select mb-3" aria-label="Default select example">
                            <option selected>نوع کاربر</option>
                            <option value="admin">admin</option>
                            <option value="user">user</option>
                        </select>

                        <div class="mb-3">
                            <label for="exampleInputEmail2" class="form-label">ایمیل</label>
                            <input type="text" name="email_user" class="form-control">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">کنسل</button>
                        <button type="submit" name="sub" class="btn btn-light-primary">ایجاد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs/dist/purecounter_vanilla.js"></script>

    <script defer src="https://unpkg.com/alpinejs@3.3.4/dist/cdn.min.js"></script>

    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
    <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

    <script src="../js/charts/chart1.js"></script>
    <script src="../js/charts/chart2.js"></script>
    <script src="../js/alpineComponents.js"></script>

    <script>
        const $ = document;
        let input =  $.querySelector('.upload-js')                                          
        input.addEventListener('change' , ()=>{
            $.querySelector('.img-js').src = URL.createObjectURL(input.files[0])
        })
    </script>
</body>

</html>
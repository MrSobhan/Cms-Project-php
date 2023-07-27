<?php
include_once('../layout/connect.php'); 

if(isset($_POST['exit'])){
    $_SESSION['login'] = 'false';
    redirect('panel/login.php');
}


global $pdo;

$query = "SELECT * FROM `shop`";
$statusment = $pdo->prepare($query);
$statusment->execute();
$shops = $statusment->fetchAll();


if(isset($_POST['sub'])){
    $name_shop = htmlspecialchars($_POST['name_shop']);
    $address_shop = htmlspecialchars($_POST['address_shop']);


    $queryinsert = "INSERT INTO `shop`(`name_shop`, `address`) VALUES (?,?)";
    $statusment1 = $pdo->prepare($queryinsert);
    $statusment1->execute([$name_shop , $address_shop]);

    redirect('shop/');
}


?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-beJoAY4VI2Q+5IPXjI207/ntOuaz06QYCdpWfWRv4lSFDyUSqsM0W+wiAMr2I185" crossorigin="anonymous">

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
                                <li class="breadcrumb-item active" aria-current="page">لیست فروشگاه ها</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="card">
                            <div class="card-header text-end">
                                <button class="btn btn-light-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    <i class="bi bi-funnel-fill"></i>
                                    ايجاد
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>نام فروشگاه</th>
                                                <th>آدرس</th>
                                                <th>عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php  foreach ($shops as $shop) { ?>
                                            <tr>
                                                <td><?= $shop->id?></td>
                                                <td class="text-muted"><?= $shop->name_shop?></td>
                                                <td class="text-muted"><?= $shop->address?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-light-primary dropdown-toggle"
                                                            type="button" id="dropdownMenuButton1"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            عملیات
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                            <li><a class="dropdown-item" href="./edit.php?id=<?= $shop->id ?>">ویرایش</a>
                                                            </li>
                                                            <li><a class="dropdown-item" href="./delete.php?id=<?= $shop->id ?>">حذف</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }?>
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
                <form action="#" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ایجاد فروشگاه</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">نام فروشگاه</label>
                            <input type="text" name="name_shop" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail2" class="form-label">آدرس فروشگاه</label>
                            <input type="text" name="address_shop" class="form-control">
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




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous">
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
</body>

</html>
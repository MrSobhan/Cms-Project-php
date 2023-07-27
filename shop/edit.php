<?php
include_once('../layout/connect.php');

global $pdo  ,$id;

if (isset($_GET['id']) && $_GET['id'] !== '') {

    $id = $_GET['id'];

    $query = "SELECT * FROM `shop` WHERE id=?";
    $statusment = $pdo->prepare($query);
    $statusment->execute([$id]);
    $shops = $statusment->fetchAll();
    
}




if (isset($_POST['sub'])) {
    $name_shop = htmlspecialchars($_POST['name_shop']);
    $address_shop = htmlspecialchars($_POST['address_shop']);


    $queryinsert = "UPDATE `shop` SET `name_shop`=?,`address`=? WHERE id=?";
    $statusment1 = $pdo->prepare($queryinsert);
    $statusment1->execute([$name_shop, $address_shop  , $id]);

    redirect('shop/');
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
                                <li class="breadcrumb-item"><a href="<?= url('panel/') ?>">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="./index.html">لیست فروشگاه ها</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ویرایش فروشگاه ها</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="card">
                            <div class="card-header text-start">
                                ویرایش فروشکاه
                            </div>
                            <div class="card-body">
                                <form action="#" method="post">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">نام فروشگاه</label>
                                        <input type="text" name="name_shop" class="form-control" value="<?= $shops[0]->name_shop ?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail2" class="form-label">آدرس فروشگاه</label>
                                        <input type="text" name="address_shop" class="form-control" value="<?= $shops[0]->address ?>">
                                    </div>

                                    <a href="<?= url('shop/')?>"><button type="button" class="btn btn-secondary">کنسل</button></a>
                                    <button type="submit" name="sub" class="btn btn-light-primary">ویرایش</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>





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
</body>

</html>
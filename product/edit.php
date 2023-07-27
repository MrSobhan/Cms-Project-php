<?php
include_once('../layout/connect.php');

global $pdo, $id;

if (isset($_GET['id']) && $_GET['id'] !== '') {

    $id = $_GET['id'];

    $query = "SELECT * FROM `products` WHERE id=?";
    $statusment = $pdo->prepare($query);
    $statusment->execute([$id]);
    $products = $statusment->fetchAll();
}else{
    redirect('product/');
}




try{
    if (isset($_POST['sub'])) {
        $name_product = htmlspecialchars($_POST['name_product']);
        $number_product = htmlspecialchars($_POST['number_product']);
        $price_product = htmlspecialchars($_POST['price_product']);
        $status = $_POST['status'];
        $discount = htmlspecialchars($_POST['discount']);
    
    
        $queryinsert = "UPDATE `products` SET `name`=?,`number`=?,`price`=?,`status`=?,`discount`=? WHERE id=?";
        $statusment1 = $pdo->prepare($queryinsert);
        $statusment1->execute([$name_product, $number_product , $price_product , $status , $discount , $id]);
    
        redirect('product/');
    
    }
}catch(PDOException $e){
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
                                <li class="breadcrumb-item"><a href="<?= url('panel/') ?>">داشبورد</a></li>
                                <li class="breadcrumb-item"><a href="./index.html">لیست محصولات</a></li>
                                <li class="breadcrumb-item active" aria-current="page">ویرایش محصولات</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="card">
                            <div class="card-header text-start">
                                ویرایش محصولات
                            </div>
                            <div class="card-body">
                                <form action="#" method="post">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">نام محصول</label>
                                        <input type="text" name="name_product" class="form-control" value="<?= $products[0]->name?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail2" class="form-label">موجودی</label>
                                        <input type="number" name="number_product" class="form-control"  value="<?= $products[0]->number?>">
                                    </div>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail2" class="form-label">قیمت محصول</label>
                                        <input type="text" name="price_product" class="form-control"  value="<?= $products[0]->price?>">
                                    </div>

                                    <select name="status" class="form-select mb-3" aria-label="Default select example">
                                        
                                        <option <?= ($products[0]->status == 1) ? "selected": "" ?> value="1">تایید شده</option>
                                        <option <?= ($products[0]->status == 0) ? "selected": "" ?> value="0">تایید نشده</option>
                                    </select>

                                    <div class="mb-3">
                                        <label for="exampleInputEmail2" class="form-label">تخفیف محصول</label>
                                        <input type="text" name="discount" class="form-control"  value="<?= $products[0]->discount?>">
                                    </div>

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">کنسل</button>
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
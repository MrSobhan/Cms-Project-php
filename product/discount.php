<?php
include_once('../layout/connect.php');

global $pdo;

$query = "SELECT * FROM `products`";
$statusment = $pdo->prepare($query);
$statusment->execute();
$discounts = $statusment->fetchAll();

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
                                <li class="breadcrumb-item active" aria-current="page">لیست تخفیف ها</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-3">
                                    <?php
                                    foreach ($discounts as $discount) {
                                        if (($discount->discount) != null) {
                                    ?>
                                            <div class="col-lg-4">
                                                <div class="card py-3 bg-light shadow" style="width: 18rem;">
                                                    <center>
                                                        <img src="https://img.freepik.com/free-photo/shopping-cart-with-gift-box-icon-promotion-discount-sale-reward-checkout-ecommerce-online-shopping-3d-illustration_56104-2102.jpg?w=996&t=st=1688826127~exp=1688826727~hmac=2f16660f491f6e7f68458693497c9b340cf559bc477ed6fb614746002c9de3df" class="card-img-top rounded w-75" alt="...">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?= $discount->name ?></h5>
                                                            <p class="card-text"><?= $discount->price ?> تومان</p>
                                                            <p class="card-text text-danger fs-2 fw-blod">تخفیف : <?= $discount->discount ?></p>
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
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
                        <h5 class="modal-title" id="exampleModalLabel">ایجاد محصول</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">نام محصول</label>
                            <input type="text" name="name_product" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail2" class="form-label">موجودی</label>
                            <input type="number" name="number_product" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail2" class="form-label">قیمت محصول</label>
                            <input type="text" name="price_product" class="form-control">
                        </div>

                        <select name="status" class="form-select mb-3" aria-label="Default select example">
                            <option selected>وضعیت</option>
                            <option value="1">تایید شده</option>
                            <option value="0">تایید نشده</option>
                        </select>

                        <div class="mb-3">
                            <label for="exampleInputEmail2" class="form-label">تخفیف محصول</label>
                            <input type="text" name="discount" class="form-control">
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
</body>

</html>
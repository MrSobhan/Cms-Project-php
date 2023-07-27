<?php include_once('../layout/connect.php');
if (isset($_POST['exit'])) {
    $_SESSION['login'] = 'false';
    redirect('panel/login.php');
}
$queryusers = "SELECT * FROM `users`";
$statusmentusers = $pdo->prepare($queryusers);
$statusmentusers->execute();
$usersnum = $statusmentusers->fetchAll();

$queryproducts = "SELECT * FROM `products`";
$statusmentproducts = $pdo->prepare($queryproducts);
$statusmentproducts->execute();
$productsnum = $statusmentproducts->fetchAll();

$queryshopnum = "SELECT * FROM `shop`";
$statusmentshop = $pdo->prepare($queryshopnum);
$statusmentshop->execute();
$shopnum = $statusmentshop->fetchAll();

$i = 0;

//Join for ends comments

$queryjoin = "SELECT  comment.date_create , comment.text , users.name , users.img   FROM `comment` LEFT JOIN `users` ON comment.user_id = users.id ORDER BY comment.date_create DESC";
$statusmentjoin = $pdo->prepare($queryjoin);
$statusmentjoin->execute();
$commentsjoin = $statusmentjoin->fetchAll();

$numjoin =0 ;
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
                    <div class="row gy-4">
                        <div class="col-xl-9">
                            <!-- Stats -->
                            <div class="row g-3">
                                <div class="col-6 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="stats-icon bg-purple">
                                                        <i class="bi bi-eye-fill lh-0"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="fs-7 text-muted">نمایش پروفایل</h6>
                                                    <h6 class="fw-bold mb-0 purecounter" data-purecounter-start="0" data-purecounter-end="18600"><?= count($usersnum) ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="stats-icon bg-blue">
                                                        <i class="bi bi-person-fill lh-0"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="fs-7 text-muted">نمایش محصولات</h6>
                                                    <h6 class="fw-bold mb-0 purecounter" data-purecounter-start="0" data-purecounter-end="126500"><?= count($productsnum) ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="stats-icon bg-green">
                                                        <i class="bi bi-person-plus-fill lh-0"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="fs-7 text-muted">نمایش فروشگاه</h6>
                                                    <h6 class="fw-bold mb-0 purecounter" data-purecounter-start="0" data-purecounter-end="95600"><?= count($shopnum) ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 col-xl-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <div class="stats-icon bg-red">
                                                        <i class="bi bi-bookmark-dash-fill lh-0"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <h6 class="fs-7 text-muted">نمایش کامنت</h6>
                                                    <h6 class="fw-bold mb-0 purecounter" data-purecounter-start="0" data-purecounter-end="452"><?= count($commentnum) ?></h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Chart -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="fw-bold mb-0">لورم ایپسوم</h5>
                                        </div>
                                        <div class="card-body">
                                            <div id="chartdiv" style="height: 500px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- progress bar & comments -->
                            <div class="row g-3 mt-4">
                                <div class="col-xl-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="fw-bold mb-0">لورم ایپسوم متن</h5>
                                        </div>
                                        <div class="card-body">
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-purple" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%
                                                    </div>
                                                </div>
                                                <p class="fs-7 text-muted mt-2">لورم ایپسوم متن ساختگی</p>
                                            </div>
                                            <hr>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-blue" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%
                                                    </div>
                                                </div>
                                                <p class="fs-7 text-muted mt-2">لورم ایپسوم متن ساختگی</p>
                                            </div>
                                            <hr>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-green" role="progressbar" style="width: 66%;" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100">66%
                                                    </div>
                                                </div>
                                                <p class="fs-7 text-muted mt-2">لورم ایپسوم متن ساختگی</p>
                                            </div>
                                            <hr>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-red" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%
                                                    </div>
                                                </div>
                                                <p class="fs-7 text-muted mt-2">لورم ایپسوم متن ساختگی</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="fw-bold mb-0">آخرین کامنت ها</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-hover align-middle">
                                                    <thead>
                                                        <tr>
                                                            <th>تصویر</th>
                                                            <th>نام کاربری</th>
                                                            <th>کامنت</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <?php foreach ($commentsjoin as $comment) {
                                                            if ($numjoin <= 3) {
                                                                $numjoin++ ?>
                                                                <tr>
                                                                    <td>
                                                                        <img width="50" class="img-fluid rounded-circle" src="<?= '../ProfileUsers/' . $comment->img ?>">
                                                                    </td>
                                                                    <td class="text-muted">
                                                                    <?= $comment->name ?>
                                                                    </td>
                                                                    <td class="text-muted">
                                                                    <?= $comment->text ?>
                                                                    </td>
                                                                </tr>
                                                        <?php }
                                                        } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <!-- Profile -->
                            <div class="card">
                                <div class="card-body p-4 d-flex align-items-center">
                                    <img width="70" class="img-fluid rounded-circle" src="<?= $_SESSION['img'] ?>" alt="">
                                    <div class="ms-3">
                                        <h6 class="fw-bold"><?= $_SESSION['name'] ?></h6>
                                        <p class="text-muted mb-0 dir-ltr">@Sobhan.com</p>
                                    </div>
                                </div>
                            </div>
                            <!-- Users -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="fw-bold mb-0">کاربران ابتدایی</h5>
                                </div>
                                <div class="card-body p-4">

                                    <?php foreach ($usersnum as $user) {
                                        if ($i <= 3) {
                                            $i++ ?>

                                            <div class="d-flex align-items-center mt-3">
                                                <img width="60" class="img-fluid rounded-circle" src="<?= '../ProfileUsers/' . $user->img ?>" alt="">
                                                <div class="ms-3">
                                                    <h6 class="fw-bold"><?= $user->name ?></h6>
                                                </div>
                                            </div>
                                    <?php }
                                    } ?>

                                    <div class="d-grid">
                                        <a href="<?= url('users/') ?>"><button class="btn btn-light-primary mt-3 w-100">نمایش کاربران</button></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Chart2 -->
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="fw-bold mb-0">وضعیت محصولات</h5>
                                </div>
                                <div class="card-body">
                                    <div id="chartdiv2" style="height: 300px;"></div>
                                </div>
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
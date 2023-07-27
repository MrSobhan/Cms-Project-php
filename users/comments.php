<?php
include_once('../layout/connect.php');

global $pdo;

$query = "SELECT  comment.id , comment.text , users.name , users.img , comment.status  FROM `comment` LEFT JOIN `users` ON comment.user_id = users.id";
$statusment = $pdo->prepare($query);
$statusment->execute();
$comments = $statusment->fetchAll();


try{

    if (isset($_GET['del']) && $_GET['del'] !== '') {

        $id_del = $_GET['del'];
    
        $query = "DELETE FROM `comment` WHERE id=?";
        $statusmentdel = $pdo->prepare($query);
        $statusmentdel->execute([$id_del]);
        
        redirect('users/comments.php');
    }

    if (isset($_GET['change']) && $_GET['change'] !== '' &&  $_GET['id'] !== '') {

        $id_change = ($_GET['change'] == '1') ? '0' : '1';
    
        $querychange = "UPDATE `comment` SET `status`=? WHERE id=?";
        $statusmentchange = $pdo->prepare($querychange);
        $statusmentchange->execute([$id_change , $_GET['id']]);
        
        redirect('users/comments.php');
    }

}catch(PDOException $e){
    echo 'Error : ' . $e->getMessage();
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
                                <li class="breadcrumb-item active" aria-current="page">لیست کامنت ها</li>
                            </ol>
                        </nav>
                    </div>

                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>نام کاربر</th>
                                                <th>کامنت</th>
                                                <th>وضعیت</th>
                                                <th>عملیات</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php foreach ($comments as $comment) { ?>
                                                <tr>
                                                    <td><?= $comment->id ?></td>
                                                    <td class="text-muted"><?= $comment->name ?></td>
                                                    <td class="text-muted"><?= $comment->text ?></td>
                                                    <td class="text-muted"><?= ($comment->status == '1') ? "تایید شده" :  "تایید نشده"?></td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-light-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                عملیات
                                                            </button>
                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                <li><a class="dropdown-item" href="./comments.php?change=<?= $comment->status ?>&id=<?= $comment->id ?>">تغییر وضعیت</a></li>
                                                                <li><a class="dropdown-item" href="./comments.php?del=<?= $comment->id ?>">حذف</a></li>
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
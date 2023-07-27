<?php

$querycomment = "SELECT * FROM `comment`";
$statusmentcomment = $pdo->prepare($querycomment);
$statusmentcomment->execute();
$commentnum = $statusmentcomment->fetchAll();

?>
<header class="header d-flex justify-content-between p-3 align-items-center">
    <div>
        <a href="#">
            <i @click="toggle" class="toggle-sidebar-icon bi bi-justify fs-3"></i>
        </a>
    </div>

    <div class="d-flex align-items-center">
        <div class="dropdown">
            <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="position-absolute top-0 end-50 translate-middle badge rounded-pill bg-red">
                    <?= count($commentnum)?>
                </span>
                <i class="bi bi-envelope fs-4 text-gray-600"></i>
            </div>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item fs-7" href="../users/comments.php"> لیست کامنت ها</a></li>
                <li><a class="dropdown-item fs-7" href="../users/comments.php"> کامنت های تایید شده</a></li>
                <li><a class="dropdown-item fs-7" href="../users/comments.php"> کامنت های تایید نشده</a></li>
            </ul>
        </div>

        <div class="dropdown mx-4">
            <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell fs-4 text-gray-600"></i>
            </div>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item fs-7" href="#"> لورم ایپسوم </a></li>
                <li><a class="dropdown-item fs-7" href="#"> لورم ایپسوم متن </a></li>
                <li><a class="dropdown-item fs-7" href="#"> لورم ایپسوم متن ساختگی </a></li>
            </ul>
        </div>

        <div class="dropdown">
            <div class="dropdown-toggle profile d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false">
                <img width="45" class="img-fluid rounded-circle me-2" src="<?= $_SESSION['img']?>" alt="">
                <div>
                    <h6 class="fs-6 fw-bold text-gray-600 mb-0"><?= $_SESSION['name']?></h6>
                    <p class="fs-8 text-gray-600 mb-0">سوپر ادمین</p>
                </div>
            </div>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li>
                    <a class="dropdown-item fs-7" href="#">
                        <i class="bi bi-person fs-5 me-1"></i>
                        پروفایل
                    </a>
                </li>
                <li>
                    <a class="dropdown-item fs-7" href="#">
                        <i class="bi bi-gear fs-6 me-1"></i>
                        تمام صفحه
                    </a>
                </li>
                <li>
                    <a class="dropdown-item fs-7" href="#">
                        <i class="bi bi-wallet fs-6 me-1"></i>
                        داشبورد
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <form action="#" method="post">
                    <button class="dropdown-item fs-7" name="exit" type="submit">
                        <i class="bi bi-box-arrow-left fs-5 me-1"></i>
                        خروج
                    </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
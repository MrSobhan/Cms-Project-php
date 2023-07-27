<?php

include_once('../layout/connect.php'); 


global $pdo;

$query = "SELECT * FROM `users`";
$statusment = $pdo->prepare($query);
$statusment->execute();
$users = $statusment->fetchAll();

if(isset($_POST['sub'])){
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);
    foreach ($users as $user) {
        if($email == $user->email && $pass == $user->password){
            $_SESSION['login'] = 'true';
            $_SESSION['name'] = $user->name;
            $_SESSION['img'] =  '../ProfileUsers/'.$user->img;
            redirect('panel/');
        }else{
            $_SESSION['login'] = 'false';
        }
    }
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

    <style>
        body {
            background-color: #f2f7ff;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .btn {
            background-color: #435ebe;
        }

        .card-title {
            color: #435ebe;
        }
    </style>
</head>

<body>

    <div class="card py-4 bg-light shadow" style="width: 25rem;">
        <div class="card-body">
            <center>
                <h5 class="card-title mb-4 fs-2">ورود به پنل مدیریت</h5>
            </center>


            <form action="#" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail2" class="form-label">ایمیل :</label>
                    <input type="email" name="email" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail2" class="form-label">گذرواژه :</label>
                    <input type="password" name="pass" class="form-control">
                </div>



                <center><button type="submit" name="sub" class="btn text-light w-75">ورود</button></center>
            </form>

        </div>
    </div>

</body>

</html>
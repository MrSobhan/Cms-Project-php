<?php

use function PHPSTORM_META\type;

session_start();

//config


function redirect($url){
    header('Location:http://localhost/php/cms/' . $url);
    exit;
}

function url($url){
    return 'http://localhost/php/cms/' . $url;
}

function dd($var){
    echo '<pre>';
    var_dump($var);
    exit;
}

//start pages

if($_SERVER['REQUEST_URI'] != '/php/cms/panel/login.php') {
    if(isset($_SESSION['login']) && $_SESSION['login']=='false'){
        redirect('panel/login.php');
    }
}



//connect

global $pdo ;

try{
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION , PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ];
    $pdo = new PDO("mysql:host=localhost;dbname=cms_panel" , 'root' , '' , $options);

    return $pdo;


}catch(PDOException $e){
    echo 'error : ' . $e->getMessage();
}



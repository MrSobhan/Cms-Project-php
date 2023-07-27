<?php
include_once('../layout/connect.php');

global $pdo;


try{

    if (isset($_GET['id']) && $_GET['id'] !== '') {

        $id = $_GET['id'];
    
        $query = "DELETE FROM `shop` WHERE id=?";
        $statusment = $pdo->prepare($query);
        $statusment->execute([$id]);
        
    }
    redirect('shop/');

}catch(PDOException $e){
    echo 'Error : ' . $e->getMessage();
}

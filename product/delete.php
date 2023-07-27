<?php
include_once('../layout/connect.php');

global $pdo;


try{

    if (isset($_GET['id']) && $_GET['id'] !== '') {

        $id = $_GET['id'];
    
        $query = "DELETE FROM `products` WHERE id=?";
        $statusment = $pdo->prepare($query);
        $statusment->execute([$id]);
        
    }
    redirect('product/');

}catch(PDOException $e){
    echo 'Error : ' . $e->getMessage();
}

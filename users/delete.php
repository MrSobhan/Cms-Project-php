<?php
include_once('../layout/connect.php');

global $pdo;


try {

    if (isset($_GET['id']) && $_GET['id'] !== '') {

        $id = $_GET['id'];


        //For Delete Img
        $query = "SELECT * FROM `users` WHERE id=?";
        $statusment1 = $pdo->prepare($query);
        $statusment1->execute([$id]);
        $users = $statusment1->fetchAll();

        if(file_exists('../ProfileUsers/'.$users[0]->img)){
            unlink('../ProfileUsers/'.$users[0]->img);
        }

        

        $querydelete = "DELETE FROM `users` WHERE id=?";
        $statusment = $pdo->prepare($querydelete);
        $statusment->execute([$id]);
    }
    redirect('users/');
} catch (PDOException $e) {
    echo 'Error : ' . $e->getMessage();
}

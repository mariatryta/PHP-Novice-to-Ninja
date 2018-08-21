<?php

if (isset($_POST['id'])){
    try{
        include __DIR__ . '/../includes/DatabaseConnection.php';

        //stmt preparation, then binding values and executing
        $sql = 'DELETE FROM `jokes` WHERE
              `id` = :id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $_POST['id']);
        $stmt->execute();
        header('location: templates/jokedeleted.html'); //send back to database display after submiting

    } catch(PDOException $e){
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' .
        $e->getFile() . ':' . $e->getLine();
    }
}
include  __DIR__ . '/../templates/layout.php';

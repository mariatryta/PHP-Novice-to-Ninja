<?php

if (isset($_POST['id'])){
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=jokesdatabase; charset=utf8','root','1234'); //storing the connection
        $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //must be because of silent mode

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

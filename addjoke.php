<?php

if (isset($_POST['joketext'])){
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=jokesdatabase; charset=utf8','root','1234'); //storing the connection
        $pdo -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //must be because of silent mode

        //stmt preparation, then binding values and executing
        $sql = 'INSERT INTO `jokes` SET
              `joketext` = :joketext,
              `name` = "joke xx"';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':joketext', $_POST['joketext']);
        $stmt->execute();
        header('location: jokesdata.php'); //send back to database display after submiting

    } catch(PDOException $e){
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' .
        $e->getFile() . ':' . $e->getLine();
    }
} else {
    $title = 'Wanna add a new joke? Do it here!';
    ob_start();
    include  __DIR__ . '\templates\addjokeform.php';
    $output = ob_get_clean();
}
include  __DIR__ . '\templates\layout.php';

<?php

if (isset($_POST['joketext'])){
    try{
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/DatabaseFunctions.php';

        //stmt preparation, then binding values and executing
        insertJoke($pdo, ['authorId' => 1, 'jokeText' => $_POST['joketext'], 'jokedate' => new DateTime()]);
        header('location: jokesdata.php'); //send back to database display after submiting

    } catch(PDOException $e){
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' .
        $e->getFile() . ':' . $e->getLine();
    }
} else {
    $title = 'Wanna add a new joke? Do it here!';
    ob_start();
    include  __DIR__ . '\..\templates\addjokeform.php';
    $output = ob_get_clean();
}
include  __DIR__ . '/../templates/layout.php';

<?php

if (isset($_POST['id'])){
    try{
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../includes/DatabaseFunctions.php'; // creates totaljokes variable that can be used in jokesdata.php

        //stmt preparation, then binding values and executing = old way, now using functions
        deleteJoke($pdo, $_POST['id']);
        header('location: ../templates/jokedeleted.html'); //send back to database display after submiting

    } catch(PDOException $e){
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' .
        $e->getFile() . ':' . $e->getLine();
    }
}
include  __DIR__ . '/../templates/layout.php';

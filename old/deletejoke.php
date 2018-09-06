<?php

if (isset($_POST['id'])){
    try{
        include __DIR__ . '/../includes/DatabaseConnection.php';
        include __DIR__ . '/../classes/databasetable.php'; // creates totaljokes variable that can be used in jokesdata.php

        //1. stmt preparation, then binding values and executing = old way, now using functions
        //2. delete($pdo, 'jokes', 'id', $_POST['id']);
        //3. 	
        $jokesTable = new DatabaseTable($pdo, 'jokes', 'id');
        $jokesTable->delete($_POST['id']);

        header('location: ../templates/jokedeleted.html'); //send back to database display after submiting

    } catch(PDOException $e){
        $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' .
        $e->getFile() . ':' . $e->getLine();
    }
}
include  __DIR__ . '/../templates/layout.php';

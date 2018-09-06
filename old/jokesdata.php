<?php 

// Connecting to mySQL database via PDO
// $pdo = new PDO('mysql:host=localhost;dbname=jokesdatabase','root','1234');

// Catching errors in connection
try{
    include __DIR__ . '/../includes/DatabaseConnection.php'; //including connection via function so it's reusable $pdo variable 
	include __DIR__ . '/../classes/databasetable.php';
	$jokesTable = new DatabaseTable($pdo, 'jokes', 'id'); // passing pdo varibale and arguments
	$authorsTable = new DatabaseTable($pdo, 'author', 'id');
    

  
    // Option a) Display jokes in output in layout.php where output gets html code //concataneded
        // $output = '';
        // foreach ($jokes as $joke) {
        //     $output .= '<blockquote>';
        //     $output .= '<p>';
        //     $output .= $joke;
        //     $output .= '</p>';
        //     $output .= '</blockquote>';
        // }

    // Option b) ob, save all the unique html code in a buffer and spit it out in 
    // layout.html which is the same for every page
}

catch(PDOException $e){
    $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' .
    $e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.php';

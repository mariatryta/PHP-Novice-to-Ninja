<?php 

// Connecting to mySQL database via PDO
// $pdo = new PDO('mysql:host=localhost;dbname=jokesdatabase','root','1234');

// Catching errors in connection
try{
    include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/databasetable.php';
	$jokesTable = new DatabaseTable($pdo, 'jokes', 'id');
	$authorsTable = new DatabaseTable($pdo, 'author', 'id');
    $result = $jokesTable->findAll();
    
	$jokes = [];
	foreach ($result as $joke) {
		$author = $authorsTable->findById($joke['authorId']);
		$jokes[] = [
			'id' => $joke['id'],
			'joketext' => $joke['joketext'],
			'jokedate' => $joke['jokedate'],
			'name' => $author['name'],
			'email' => $author['email']
		];
	}
    $title = 'Joke list';
  
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
    $totalJokes = total($pdo, 'jokes');

    ob_start();
    include  __DIR__ . '/../templates/jokes.php';

    $output = ob_get_clean();
}

catch(PDOException $e){
    $output = 'Unable to connect to the database server: ' . $e->getMessage() . ' in ' .
    $e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.php';

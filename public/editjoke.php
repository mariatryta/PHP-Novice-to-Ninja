<?php
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';
    try { //update text
		if (isset($_POST['joketext'])) {
		updateJoke($pdo,[
			'id' => $_POST['jokeid'],
			'joketext' => $_POST ['joketext'],
			'authorid' => 1
		]);
		header('location: jokesdata.php');  
	}
	else { //retrieve the text
		$joke = getJoke($pdo, $_GET['id']);
		$title = 'Edit joke';
		ob_start();
		include  __DIR__ . '/../templates/editjokelayout.php';
		$output = ob_get_clean();
	}
}
    catch (PDOException $e) {
	$title = 'An error has occurred';
	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
}
    include  __DIR__ . '/../templates/layout.php';
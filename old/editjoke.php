<?php
try { //update text

	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/databasetable.php';

	$jokesTable = new DatabaseTable($pdo, 'jokes', 'id');
		if (isset($_POST['joke'])) {

			$joke = $_POST['joke'];
			$joke['jokedate'] = new DateTime();
			$joke['authorid'] =1;

			$jokesTable->save($joke);
			header('location: index.php');  
	}
	else { 
		if (isset($_GET['id'])) {
			$joke = $jokesTable->findById($_GET['id']);
		}
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
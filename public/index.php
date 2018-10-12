<?php
try {
	include __DIR__ . '/../classes/entrypoint.php';
	include __DIR__ . '/../classes/ijdbroutes.php';
	
	$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/'); //strip url to get the final route variable 
	$entryPoint = new EntryPoint($route,new IjdbRoutes()); //create new route using entrypoint class and auto check urls
	$entryPoint->run(); // determine which joke/... should run using CallAction  
}
catch (PDOException $e) {
	$title = 'An error has occurred';
	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
	include  __DIR__ . '/../templates/layout.html.php';
}
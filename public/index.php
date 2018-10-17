<?php
try {
	include __DIR__ . '/../includes/autoloader.php';
	
	$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/'); //strip url to get the final route variable 
	$entryPoint = new \Framework\EntryPoint($route, $_SERVER['REQUEST_METHOD'],new \Ijdb\IjdbRoutes()); //create new route using entrypoint class and auto check urls
	$entryPoint->run(); // determine which joke/... should run using CallAction  
}
catch (PDOException $e) {
	$title = 'An error has occurred';
	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
	include  __DIR__ . '/../templates/layout.html.php';
} 
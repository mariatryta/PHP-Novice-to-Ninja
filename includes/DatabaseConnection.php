<?php 
$pdo = new PDO('mysql:host=localhost;dbname=jokesdatabase; charset=utf8','jaja','1234'); //storing the connection
$pdo->setAttribute(PDO::ATTR_ERRMODE, 
PDO::ERRMODE_EXCEPTION);
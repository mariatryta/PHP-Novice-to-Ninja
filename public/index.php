<?php
$title = 'Internet Joke Database';
ob_start();
include  __DIR__ . '/../templates/home.php';//saves home html part
$output = ob_get_clean(); // outputs it into layout html 
include  __DIR__ . '/../templates/layout.php'; // layout html shows on index with home uniqueness 
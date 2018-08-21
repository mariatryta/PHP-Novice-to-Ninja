<?php
function query($pdo, $sql, $parameters = []) {
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}


function totalJokes($pdo) {
    $query = query($pdo, 'SELECT COUNT(*) FROM `jokes`');
    $row = $query->fetch();
    return $row[0];
  }
  
function getJoke($pdo, $id) {
	
	//Create the array of `$parameters` for use in the `query` function
	$parameters = [':id' => $id];
	//call the query function and provide the `$parameters` array
	$query = query($pdo, 'SELECT * FROM `jokes` WHERE `id` = :id', $parameters);
	return $query->fetch();
}

// add joke function
function insertJoke($pdo, $joketext, $authorId) {
	$query = 'INSERT INTO `jokes` (`joketext`, `jokedate`, `authorid`) 
			  VALUES (:joketext, CURDATE(), :authorId)';
	$parameters = [':joketext' => $joketext, ':authorId' => $authorId];
	query($pdo, $query, $parameters);
}  

// Update joke
function updateJoke($pdo, $jokeId, $joketext, $authorId){ 
    $parameters = [':joketext' => $joketext,
                    ':authorId' => $authorId,
                    ':id' => $jokeId];
    query($pdo, 'UPDATE `jokes` SET `authorId` = :authorId,`joketext` = :joketext 
                 WHERE `id` = :id', $parameters); 
}
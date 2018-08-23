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
function insertJoke($pdo, $fields) {
	$query = 'INSERT INTO `jokes` (';

	foreach ($fields as $key => $value){
		$query .= '`' . $key . '`,';
	}

	$query = rtrim($query, ',');
	
	$query .= ') VALUES (';

	foreach ($fields as $key => $value){
		$query .= ':' . $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= ')'; 

	// loops through values and when it finds datetime it helps it convert to mysql format
	$fields = processDates($fields);

	query($pdo, $query);
}  

// Update joke
function updateJoke($pdo, $fields){ 
	// start updating query
   $query = 'UPDATE `jokes` SET';
	//generate the query dynamicaly, loop over the singles
   foreach($array as $key => $value){
	   $query .=  '`' . $key . '` = :' . $key . ',';
   }
   // stripping the ending comma to make query run
   $query = rtrim($query, ',');
   // concat the rest of the query with .=
   $query .= ' WHERE `id` = :primaryKey'; 

	//    time convert
	$fields = processDates($fields);
   // Set the :primaryKey variable
   $fields['primaryKey'] = $fields['id'];
   query($pdo, $query, $fields); 
}

// Delete joke
function deleteJoke ($pdo, $id){
	$parameters = [':id' => $id];

	query($pdo, 'DELETE FROM `jokes` WHERE `id` = :id', $parameters); 
}

// Fetch all jokes
function allJokes($pdo) {
	$jokes =  query($pdo, 'SELECT `jokes`.`id`, `joketext`, `jokedate`, `name`, `email`
		FROM `jokes` INNER JOIN `author`
		ON `authorid` = `author`.`id`');
	return $jokes->fetchAll();
}

//  date processing function 
function processDates($fields) {
	foreach ($fields as $key => $value) {
		if ($value instanceof DateTime) {
			$fields[$key] = $value->format('Y-m-d');
		}
	}
	return $fields;
}

// retrieve authors
function allAuthors($pdo) {
	$authors =  query($pdo, 'SELECT * FROM `author`');
	
	return $authors->fetchAll(); 
}

function deleteAuthors($pdo){
	$parameters = [':id' => $id];

	query($pdo, 'DELETE FROM `author`
	WHERE `id` = :id', $parameters);
}

function insertAuthor($pdo, $fields){
	$query = 'INSERT INTO `author` (';

	foreach ($fields as $key => $value) {
		$query .= '`' . $key . '`,';
	}

	$query = rtrim($query, ',');
	$query .= ') VALUES (';

	foreach ($fields as $key => $value) {
		$query .= ':' . $key . ',';
	}

	$query = rtrim($query, ',');
	$query .= ')';

	$fields = processDates($fields);
	query($pdo, $query, $fields); 

}
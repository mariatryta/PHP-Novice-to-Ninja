<?php
function query($pdo, $sql, $parameters = []) {
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}
function total($pdo, $table) {
	$query = query($pdo, 'SELECT COUNT(*) FROM `' . $table . '`');
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
//  Using generic function for all - authors, jokes ...
function findAll($pdo, $table) {
	$result = query($pdo, 'SELECT * FROM `' . $table . '`');
	return $result->fetchAll(); 
}

function findById($pdo, $table, $primaryKey, $value) {
	$query = 'SELECT * FROM `' . $table . '` WHERE `' . $primaryKey . '` = :value';
	$parameters = [
		'value' => $value
	];
	$query = query($pdo, $query, $parameters);
	return $query->fetch();
}
// Generic Delete function
function delete($pdo, $table, $primaryKey, $id ) {
	$parameters = [':id' => $id];
	query($pdo, 'DELETE FROM `' . $table . '` WHERE `' . $primaryKey . '` = :id', $parameters);  //using primary key for more variability > reuse function in different scenarios
}
// generic insert
function insert($pdo, $table, $fields) {
	$query = 'INSERT INTO `' . $table . '` (';
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
//generic update
function update($pdo, $table, $primaryKey, $fields) {
	$query = ' UPDATE `' . $table .'` SET ';
	foreach ($fields as $key => $value) {
		$query .= '`' . $key . '` = :' . $key . ',';
	}
	$query = rtrim($query, ',');
	$query .= ' WHERE `' . $primaryKey . '` = :primaryKey';
	//Set the :primaryKey variable
	$fields['primaryKey'] = $fields['id'];
	$fields = processDates($fields);
	query($pdo, $query, $fields);
}
//save function for editing and adding joke with one function
function save($pdo, $table, $primaryKey, $record){
	try{
		if ($record[$primaryKey] == '') {
			$record[$primaryKey] == null;
		}
		insert($pdo, $table, $record);
	}
	catch (PDOException $e) {
		update($pdo, $table, $primaryKey, $record);
	}
}
// retrieve authors
	// function allAuthors($pdo) {
	// 	$authors =  query($pdo, 'SELECT * FROM `author`');
		
	// 	return $authors->fetchAll(); 
	// }


// function deleteAuthors($pdo){
	// 	$parameters = [':id' => $id];

	// 	query($pdo, 'DELETE FROM `author`
	// 	WHERE `id` = :id', $parameters);
	// }


//Insert author
	// function insertAuthor($pdo, $fields){
	// 	$query = 'INSERT INTO `author` (';

	// 	foreach ($fields as $key => $value) {
	// 		$query .= '`' . $key . '`,';
	// 	}

	// 	$query = rtrim($query, ',');
	// 	$query .= ') VALUES (';

	// 	foreach ($fields as $key => $value) {
	// 		$query .= ':' . $key . ',';
	// 	}

	// 	$query = rtrim($query, ',');
	// 	$query .= ')';

	// 	$fields = processDates($fields);
	// 	query($pdo, $query, $fields); 

	// }

// add joke function
	// function insertJoke($pdo, $fields) {
	// 	$query = 'INSERT INTO `jokes` (';

	// 	foreach ($fields as $key => $value){
	// 		$query .= '`' . $key . '`,';
	// 	}

	// 	$query = rtrim($query, ',');
		
	// 	$query .= ') VALUES (';

	// 	foreach ($fields as $key => $value){
	// 		$query .= ':' . $key . ',';
	// 	}

	// 	$query = rtrim($query, ',');

	// 	$query .= ')'; 

	// 	// loops through values and when it finds datetime it helps it convert to mysql format
	// 	$fields = processDates($fields);

	// 	query($pdo, $query);
	// }  

// // Update joke
	// function updateJoke($pdo, $fields){ 
	// 	// start updating query
	//    $query = 'UPDATE `jokes` SET';
	// 	//generate the query dynamicaly, loop over the singles
	//    foreach($array as $key => $value){
	// 	   $query .=  '`' . $key . '` = :' . $key . ',';
	//    }
	//    // stripping the ending comma to make query run
	//    $query = rtrim($query, ',');
	//    // concat the rest of the query with .=
	//    $query .= ' WHERE `id` = :primaryKey'; 

	// 	//    time convert
	// 	$fields = processDates($fields);
	//    // Set the :primaryKey variable
	//    $fields['primaryKey'] = $fields['id'];
	//    query($pdo, $query, $fields); 
	// }

// Delete joke
	// function deleteJoke ($pdo, $id){
	// 	$parameters = [':id' => $id];

	// 	query($pdo, 'DELETE FROM `jokes` WHERE `id` = :id', $parameters); 
	// }
	
// total jokes
	// function totalJokes($pdo) {
	//     $query = query($pdo, 'SELECT COUNT(*) FROM `jokes`');
	//     $row = $query->fetch();
	//     return $row[0];
	//   }
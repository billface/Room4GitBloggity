<?php

/* special query function that sets the $parameters variable to an empty array 
if no value is supplied */
function query($pdo, $sql, $parameters = []) {
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}
//shows how many blogs have been added
function total($pdo, $table) {
	$query = query($pdo, 'SELECT COUNT(*) FROM `' . $table . '`');
	$row = $query->fetch();
	return $row[0];
}

//used to display blogs on blogs.php
function allBlogs($pdo) {

	$blogs = query($pdo, 'SELECT `blog`.`id`, `blogheading`, `blogdate`, `name`, `email`
          FROM `blog` INNER JOIN `author`
          ON `authorid` = `author`.`id`');

	return $blogs->fetchAll();

}



//displays comments on wholeblog.php
function allComments($pdo, $id) {

	$parameters = [':id' => $id];

	$comments = query($pdo, 'SELECT `comments`.`id`, `commtext`, `name`, `email`, `commdate`, `commmoddate`
          FROM `comments` INNER JOIN `author`
          ON `authorid` = `author`.`id` WHERE `comments`.`commblogid` = :id', $parameters);

	return $comments->fetchAll();
}


//displays blog on wholeblog.php
function wholeBlog($pdo, $id) {
	
	//Create the array of `$parameters` for use in the `query` function
	$parameters = [':id' => $id];


	//call the query function and provide the `$parameters` array
	$query = query($pdo, 'SELECT blog.id AS blogId, author.id AS authorId , `blogheading`, `blogtext`, `blogdate`, `blogmoddate`, `name`, `email` FROM `blog` INNER JOIN `author`
	ON `authorid` = `author`.`id`  WHERE `blog`.`id` = :id', $parameters);

	return $query->fetch();
}



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

function findById($pdo, $table, $primaryKey, $value) {
	$query = 'SELECT * FROM `' . $table . '` WHERE `' . $primaryKey . '` = :value';

	$parameters = [
		'value' => $value
	];

	$query = query($pdo, $query, $parameters);

	return $query->fetch();
}

function findAllById($pdo, $table, $primaryKey, $value) {
	$query = 'SELECT * FROM `' . $table . '` WHERE `' . $primaryKey . '` = :value';

	$parameters = [ 
		'value' => $value
	];

	$query = query($pdo, $query, $parameters);

	return $query->fetchAll();
}

function findAll($pdo, $table) {
	$result = query($pdo, 'SELECT * FROM `' . $table . '`');

	return $result->fetchAll();
}


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

function delete($pdo, $table, $primaryKey, $id ) {
	$parameters = [':id' => $id];

	query($pdo, 'DELETE FROM `' . $table . '` WHERE `' . $primaryKey . '` = :id', $parameters);
}




  function processDates($fields) {
	foreach ($fields as $key => $value) {
		if ($value instanceof DateTime) {
			$fields[$key] = $value->format('Y-m-d H:i:s');
		}
	}

	return $fields;
}
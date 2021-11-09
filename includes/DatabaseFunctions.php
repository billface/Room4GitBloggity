<?php

/* special query function that sets the $parameters variable to an empty array 
if no value is supplied */
function query($pdo, $sql, $parameters = []) {
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}

function totalBlogs($pdo) {
	$query = query($pdo, 'SELECT COUNT(*) FROM `blog`');
	$row = $query->fetch();

	return $row[0];
}

function getBlog($pdo, $id) {
	
	//Create the array of `$parameters` for use in the `query` function
	$parameters = [':id' => $id];


	//call the query function and provide the `$parameters` array
	$query = query($pdo, 'SELECT * FROM `blog` WHERE `id` = :id', $parameters);

	return $query->fetch();
}

function allBlogs($pdo) {

	$jokes = query($pdo, 'SELECT `blog`.`id`, `blogtext`, `name`, `email`
          FROM `blog` INNER JOIN `author`
          ON `authorid` = `author`.`id`');

	return $jokes->fetchAll();

}

function wholeBlog($pdo, $id) {
	
	//Create the array of `$parameters` for use in the `query` function
	$parameters = [':id' => $id];


	//call the query function and provide the `$parameters` array
	$query = query($pdo, 'SELECT * FROM `blog` INNER JOIN `author`
	ON `authorid` = `author`.`id` WHERE `blog`.`id` = :id', $parameters);

	return $query->fetch();
}

function insertBlog($pdo, $blogtext, $authorId) {
	$query = 'INSERT INTO `blog` (`blogtext`, `blogdate`, `authorId`) 
			  VALUES (:blogtext, CURDATE(), :authorId)';

	$parameters = [':blogtext' => $blogtext, ':authorId' => $authorId];

	query($pdo, $query, $parameters);
}

function updateBlog($pdo, $blogId, $blogtext, $authorId) {
	$parameters = [':blogtext' => $blogtext, ':authorId' => $authorId, ':id' => $blogId];
  
	query($pdo, 'UPDATE `blog` SET `authorId` = :authorId, `blogtext` = :blogtext WHERE `id` = :id', $parameters);
  }

function deleteBlog($pdo, $id) {
	$parameters = [':id' => $id];
  
	query($pdo, 'DELETE FROM `blog` WHERE `id` = :id', $parameters);
  }
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

	$blogs = query($pdo, 'SELECT `blog`.`id`, `blogheading`, `name`, `email`
          FROM `blog` INNER JOIN `author`
          ON `authorid` = `author`.`id`');

	return $blogs->fetchAll();

}

function allComments($pdo) {

	$comments = query($pdo, 'SELECT `comments`.`id`, `commtext`, `name`, `email`
          FROM `comments` INNER JOIN `author`
          ON `authorid` = `author`.`id`');

	return $comments->fetchAll();
}



function wholeBlog($pdo, $id) {
	
	//Create the array of `$parameters` for use in the `query` function
	$parameters = [':id' => $id];


	//call the query function and provide the `$parameters` array
	$query = query($pdo, 'SELECT * FROM `blog` INNER JOIN `author`
	ON `authorid` = `author`.`id` /*INNER JOIN `comments` ON `blog`.`id` = `blogid`*/ WHERE `blog`.`id` = :id', $parameters);

	return $query->fetch();
}


function insertComment($pdo, $commtext, $authorId, $commblogId) {
	$query = 'INSERT INTO `comments` (`commtext`, `commdate`, `authorid`, `commblogId`) 
			  VALUES (:commtext, CURDATE(), :authorId, :commblogId)';

	$parameters = [':commtext' => $commtext, ':authorId' => $authorId, ':commblogId' => $blogId];

	query($pdo, $query, $parameters);
}

function insertBlog($pdo, $blogheading, $blogtext,  $authorId) {
	$query = 'INSERT INTO `blog` (`blogheading`, `blogtext`, `blogdate`, `authorId`) 
			  VALUES (:blogheading, :blogtext, CURDATE(), :authorId)';

	$parameters = [':blogheading' => $blogheading,':blogtext' => $blogtext, ':authorId' => $authorId];

	query($pdo, $query, $parameters);
}

function updateBlog($pdo, $blogId, $blogheading, $blogtext, $authorId) {
	$parameters = [':blogheading' => $blogheading,':blogtext' => $blogtext, ':authorId' => $authorId, ':id' => $blogId];
  
	query($pdo, 'UPDATE `blog` SET `authorId` = :authorId, `blogheading` = :blogheading, `blogtext` = :blogtext WHERE `id` = :id', $parameters);
  }

function deleteBlog($pdo, $id) {
	$parameters = [':id' => $id];
  
	query($pdo, 'DELETE FROM `blog` WHERE `id` = :id', $parameters);
  }
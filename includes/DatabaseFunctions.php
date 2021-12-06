<?php

/* special query function that sets the $parameters variable to an empty array 
if no value is supplied */
function query($pdo, $sql, $parameters = []) {
	$query = $pdo->prepare($sql);
	$query->execute($parameters);
	return $query;
}
//shows how many blogs have been added
function totalBlogs($pdo) {
	$query = query($pdo, 'SELECT COUNT(*) FROM `blog`');
	$row = $query->fetch();

	return $row[0];
}

//used to display blogs on blogs.php
function allBlogs($pdo) {

	$blogs = query($pdo, 'SELECT `blog`.`id`, `blogheading`, `name`, `email`
          FROM `blog` INNER JOIN `author`
          ON `authorid` = `author`.`id`');

	return $blogs->fetchAll();

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

//inserts comment on wholeblog.php
function insertComment($pdo, $commtext, $authorId, $commblogId) {
	$query = 'INSERT INTO `comments` (`commtext`, `commdate`, `authorid`, `commblogId`) 
			  VALUES (:commtext, CURDATE(), :authorId, :commblogId)';

	$parameters = [':commtext' => $commtext, ':authorId' => $authorId, ':commblogId' => $commblogId];

	query($pdo, $query, $parameters);
}
/*
//used on addblog.php
function insertBlog($pdo, $blogheading, $blogtext,  $authorId) {
	$query = 'INSERT INTO `blog` (`blogheading`, `blogtext`, `blogdate`, `authorId`) 
			  VALUES (:blogheading, :blogtext, CURDATE(), :authorId)';

	$parameters = [':blogheading' => $blogheading,':blogtext' => $blogtext, ':authorId' => $authorId ];

	query($pdo, $query, $parameters);
}
*/

//used on addblog.php
function insertBlog($pdo, $fields) {
	$query = 'INSERT INTO `blog` (';
	
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

	query($pdo, $query, $fields);
}


//retrieves blogs for the editblog.php page
function getBlog($pdo, $id) {
	
	//Create the array of `$parameters` for use in the `query` function
	$parameters = [':id' => $id];

	//call the query function and provide the `$parameters` array
	$query = query($pdo, 'SELECT * FROM `blog` WHERE `id` = :id', $parameters);

	return $query->fetch();
}

//displays comments on wholeblog.php
function allComments($pdo, $id) {

	$parameters = [':id' => $id];

	$comments = query($pdo, 'SELECT `comments`.`id`, `commtext`, `name`, `email`, `commdate`, `commmoddate`
          FROM `comments` INNER JOIN `author`
          ON `authorid` = `author`.`id` WHERE `comments`.`commblogid` = :id', $parameters);

	return $comments->fetchAll();
}

function getComment($pdo, $id) {
	
	//Create the array of `$parameters` for use in the `query` function
	$parameters = [':id' => $id];

	//call the query function and provide the `$parameters` array
	$query = query($pdo, 'SELECT * FROM `comments` WHERE `id` = :id', $parameters);

	return $query->fetch();
}

/*
  //used on editblog.php
function updateBlog($pdo, $blogId, $blogheading, $blogtext, $authorId) {
	$parameters = [':blogheading' => $blogheading,':blogtext' => $blogtext, ':authorId' => $authorId, ':id' => $blogId];
  
	query($pdo, 'UPDATE `blog` SET `authorId` = :authorId, `blogheading` = :blogheading, `blogtext` = :blogtext, `blogmoddate` = NOW() WHERE `id` = :id', $parameters);
  }

  */

//used on editblog.php
function updateBlog($pdo, $fields) {

	$query = 'UPDATE `blog` SET ';

	foreach ($fields as $key => $value) {
		$query .= '`' . $key . '` = :' . $key . ',';
	}

	$query = rtrim($query, ',');

	$query .= 'WHERE `id` = :primaryKey';

	//set the :primaryKey variable
	$fields['primaryKey'] = $fields['id'];

	query($pdo, $query, $fields);

}


function updateComment($pdo, $commentsId, $commtext, $authorId) {
	$parameters = [':commtext' => $commtext, ':authorId' => $authorId, ':id' => $commentsId];
  
	query($pdo, 'UPDATE `comments` SET `authorId` = :authorId, `commtext` = :commtext, `commmoddate` = NOW() WHERE `id` = :id', $parameters);
  }

// delete blog.php
function deleteBlog($pdo, $id) {
	$parameters = [':id' => $id];
  
	query($pdo, 'DELETE FROM `blog` WHERE `id` = :id', $parameters);
  }
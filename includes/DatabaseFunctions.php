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
//retrieves blogs for the editblog.php page
function getBlog($pdo, $id) {
	
	//Create the array of `$parameters` for use in the `query` function
	$parameters = [':id' => $id];


	//call the query function and provide the `$parameters` array
	$query = query($pdo, 'SELECT * FROM `blog` WHERE `id` = :id', $parameters);

	return $query->fetch();
}
//used to display blogs on blogs.php
function allBlogs($pdo) {

	$blogs = query($pdo, 'SELECT `blog`.`id`, `blogheading`, `name`, `email`
          FROM `blog` INNER JOIN `author`
          ON `authorid` = `author`.`id`');

	return $blogs->fetchAll();

}
//displays comments on wholeblog.php
function allComments($pdo, $id) {

	$parameters = [':id' => $id];

	$comments = query($pdo, 'SELECT `comments`.`id`, `commtext`, `name`, `email`
          FROM `comments` INNER JOIN `author`
          ON `authorid` = `author`.`id` WHERE `comments`.`commblogid` = :id', $parameters);

	return $comments->fetchAll();
}

//displays blog on wholeblog.php
function wholeBlog($pdo, $id) {
	
	//Create the array of `$parameters` for use in the `query` function
	$parameters = [':id' => $id];


	//call the query function and provide the `$parameters` array
	$query = query($pdo, 'SELECT blog.id AS blogId, author.id AS authorId , `blogheading`, `blogtext`, `name`, `email` FROM `blog` INNER JOIN `author`
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

//used on add blog.php
function insertBlog($pdo, $blogheading, $blogtext,  $authorId) {
	$query = 'INSERT INTO `blog` (`blogheading`, `blogtext`, `blogdate`, `authorId`, `blogmoddate`) 
			  VALUES (:blogheading, :blogtext, CURDATE(), :authorId, NOW())';

	$parameters = [':blogheading' => $blogheading,':blogtext' => $blogtext, ':authorId' => $authorId ];

	query($pdo, $query, $parameters);
}

//used on addblog.php
function updateBlog($pdo, $blogId, $blogheading, $blogtext, $authorId) {
	$parameters = [':blogheading' => $blogheading,':blogtext' => $blogtext, ':authorId' => $authorId, ':id' => $blogId];
  
	query($pdo, 'UPDATE `blog` SET `authorId` = :authorId, `blogheading` = :blogheading, `blogtext` = :blogtext, `blogmoddate` = NOW() WHERE `id` = :id', $parameters);
  }
// delete blog.php
function deleteBlog($pdo, $id) {
	$parameters = [':id' => $id];
  
	query($pdo, 'DELETE FROM `blog` WHERE `id` = :id', $parameters);
  }
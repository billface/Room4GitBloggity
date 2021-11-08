<?php

function totalBlogs($database) {
	$query = $database->prepare('SELECT COUNT(*) FROM `blog`');
	$query->execute();

	$row = $query->fetch();

	return $row[0];
}

?>
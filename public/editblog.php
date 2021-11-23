<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
		if (isset($_POST['blogtext'])) {

		updateBlog($pdo, $_POST['blogid'], $_POST['blogheading'], $_POST['blogtext'], 2);

		header('location: blogs.php');  

	}
	else {

		$blog = getBlog($pdo, $_GET['id']);

		$title = 'Edit blog';

		ob_start();

		include  __DIR__ . '/../templates/editblog.html.php';

		$output = ob_get_clean();
	}
}
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';
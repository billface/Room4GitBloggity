<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {

	if (isset($_POST['blog'])) {
		
		$blog = $_POST['blog'];
		//the above is from form, below is others
		$blog['blogModDate'] = new DateTime();
		$blog['authorId'] = 2;

		save($pdo, 'blog', 'id',  $blog);

		header('location: wholeblog.php?id=' . $blog['id']);
	
	}

	else {

	
		$blog = findById($pdo, 'blog', 'id', $_GET['id']);


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
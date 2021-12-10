<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
		if (isset($_POST['blogtext'])) {

		update($pdo, 'blog', 'id',  [
				'id' => $_POST['blogid'],
				'blogheading' => $_POST['blogheading'],
				'blogtext' => $_POST['blogtext'], 
				'authorId' => 2,
				'blogmoddate' => new DateTime
			]);

		header('location: wholeblog.php?id=' . $_POST['blogid']);
		die;  

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
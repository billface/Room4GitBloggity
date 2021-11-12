<?php


try {

    include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

		$blog = wholeBlog($pdo, $_GET['id']);

		$comments = allComments($pdo);

		if (isset($_POST['commtext'])) {

		// 1 currently represents the author id & blog id
		insertComment($pdo, $_POST['commtext'], 1 , 1);
		
		//head back to the current page after inserting comment
		header('location: '.$_SERVER['PHP_SELF']);
		die;

		}

		else {

		$title = 'Whole blog';

		ob_start();

		include  __DIR__ . '/../templates/wholeblog.html.php';

		$output = ob_get_clean();

	}
	}

catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';
<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
		if (isset($_POST['commText'])) {

		

		updateComment($pdo, [
			'id' => $_POST['commentId'],
			'commText' => $_POST['commText'],
			'authorId' => 2,
			'commModDate' => new DateTime
		]);

		//header('location:blogs.php');
        header('location: wholeblog.php?id=' . $_POST['commBlogId']);  

	}
	else {

		$comment = getComment($pdo, $_GET['id']);

		$title = 'Edit comment';

		ob_start();

		include  __DIR__ . '/../templates/editcomment.html.php';

		$output = ob_get_clean();
	}
}
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';
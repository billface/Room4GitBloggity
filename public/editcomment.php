<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
		if (isset($_POST['comment'])) {

			$comment = $_POST['comment'];
			$comment['authorId'] = 2;
			$comment['commModDate'] = new DateTime();

			save($pdo, 'comment', 'id',  $comment);

        	header('location: wholeblog.php?id=' . $comment['commBlogId']);  

		}
		else {

			$comment = findById($pdo, 'blog', 'id', $_GET['id']);
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
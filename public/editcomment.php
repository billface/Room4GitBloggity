<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../classes/DatabaseTable.php';

try {

	$commentsTable = new DatabaseTable($pdo, 'comment', 'id');

		if (isset($_POST['comment'])) {

			$comment = $_POST['comment'];
			$comment['authorId'] = 2;
			$comment['commModDate'] = new DateTime();

			$commentsTable->save($comment);

        	header('location: wholeblog.php?id=' . $comment['commBlogId']);  

		}
		else {

			$comment = $commentsTable->findById($_GET['id']);
			$title = ' comment';

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
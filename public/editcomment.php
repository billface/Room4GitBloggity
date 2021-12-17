<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
		if (isset($_POST['comments'])) {

			$comments = $_POST['comments'];
			$comments['authorId'] = 2;
			$comments['commModDate'] = new DateTime();

			save($pdo, 'comments', 'id',  $comments);

        	header('location: wholeblog.php?id=' . $comments['commBlogId']);  

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
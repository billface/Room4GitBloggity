<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
		if (isset($_POST['commText'])) {

		

		update($pdo, 'comments', 'id', [
			'id' => $_POST['commentId'],
			'commText' => $_POST['commText'],
			'authorId' => 2,
			'commModDate' => new DateTime
		]);

        header('location: wholeblog.php?id=' . $_POST['commBlogId']);  

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
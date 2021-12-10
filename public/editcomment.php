<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
include __DIR__ . '/../includes/DatabaseFunctions.php';

try {
		if (isset($_POST['commtext'])) {

		

		update($pdo, 'comments', 'id', [
			'id' => $_POST['commentsid'],
			'commtext' => $_POST['commtext'],
			'authorId' => 2,
			'commmoddate' => new DateTime
		]);

		//header('location:blogs.php');
        header('location: wholeblog.php?id=' . $_POST['commblogId']);  

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
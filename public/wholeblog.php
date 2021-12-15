<?php


try {

    include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';

		$blog = wholeBlog($pdo, $_GET['id']);
		
		$result = findAllById($pdo, 'comments', 'commblogid', $_GET['id']);

		$comments = [];
			foreach ($result as $comment) {
				$author = findById($pdo, 'author', 'id', $comment['authorid']);

			$comments[] = [
					'id' => $comment['id'],
					'commtext' => $comment['commtext'],
					'commdate' => $comment['commdate'],
					'commblogid' => $comment['commblogid'],
					'commmoddate' => $comment['commmoddate'],
					'name' => $author['name'],
					'email' => $author['email']
				];
		

			}

		if (isset($_POST['commtext'])) {

		// 1 currently represents the author id & blog id
		insert($pdo, 'comments', [
			'commtext' => $_POST['commtext'],
			'authorId' => 2,
			'commblogId' => $_POST['commblogId'],
			'commdate' => new Datetime()
		]);
	
		//head back to the current page after inserting comment
		header('location: '.$_SERVER['PHP_SELF'] . '?id=' . $_POST['commblogId']);
		die;

		}

		else {
			$comment2edit = findById($pdo, 'comments', 'id', $_GET['commentId']);
			
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
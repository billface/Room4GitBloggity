<?php


try {

    include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../includes/DatabaseFunctions.php';


		$result = findAllById($pdo, 'blog', 'id', $_GET['id']);

		$blogs = [];
			foreach ($result as $blog) {
				$author = findById($pdo, 'author', 'id', $blog['authorId']);

			$blogs[] = [
					'id' => $blog['id'],
					'blogHeading' => $blog['blogHeading'],
					'blogText' => $blog['blogText'],
					'blogDate' => $blog['blogDate'],
					'blogModDate' => $blog['blogModDate'],
					'name' => $author['name'],
					'email' => $author['email']
				];

			}
		
		$resultComm = findAllById($pdo, 'comments', 'commBlogId', $_GET['id']);

		$comments = [];
			foreach ($resultComm as $comment) {
				$author = findById($pdo, 'author', 'id', $comment['authorId']);

			$comments[] = [
					'id' => $comment['id'],
					'commText' => $comment['commText'],
					'commDate' => $comment['commDate'],
					'commBlogId' => $comment['commBlogId'],
					'commModDate' => $comment['commModDate'],
					'name' => $author['name'],
					'email' => $author['email']
				];
		

		}

		if (isset($_POST['comments'])) {

		// 1 currently represents the author id & blog id
		
			$comments = $_POST['comments'];
			$comments['authorId'] = 2;
			$comments['commDate'] = new Datetime();
	

			save($pdo, 'comments', 'id', $comments);
		
			//head back to the current page after inserting comment
			header('location: '.$_SERVER['PHP_SELF'] . '?id=' . $_POST['commBlogId']);
			die;

		}

		else {

			if (isset($_GET['commentId'])) {
				
			$comment2edit = findById($pdo, 'comments', 'id', $_GET['commentId']);

			}
			
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
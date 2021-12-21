<?php


try {

    include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/DatabaseTable.php';

	$blogsTable = new DatabaseTable($pdo, 'blog', 'id');
	$authorsTable = new DatabaseTable($pdo, 'author', 'id');
	$commentsTable = new DatabaseTable($pdo, 'comment', 'commBlogId');


		$result = $blogsTable->findAllById($_GET['id']);

		$blogs = [];
			foreach ($result as $blog) {
				$author = $authorsTable->findById($blog['authorId']);

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
		
		$resultComm = $commentsTable->findAllById($_GET['id']);

		$comments = [];
			foreach ($resultComm as $comment) {
				$author = $authorsTable->findById($comment['authorId']);

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

		if (isset($_POST['comment'])) {

		// 1 currently represents the author id & blog id
		
			$comment = $_POST['comment'];
			$comment['authorId'] = 2;
			$comment['commDate'] = new Datetime();
	

			save($pdo, 'comment', 'id', $comment);
		
			//head back to the current page after inserting comment
			header('location: '.$_SERVER['PHP_SELF'] . '?id=' . $_POST['commBlogId']);
			die;

		}

		else {

			if (isset($_GET['commentId'])) {
				
			$comment2edit = findById($pdo, 'comment', 'id', $_GET['commentId']);

			}
			
		$title = 'Whole bloggity';

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
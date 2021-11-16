<?php


try {

    include __DIR__ . '/../includes/DatabaseConnection.php';
	//include __DIR__ . '/../includes/DatabaseFunctions.php';

	function wholeBlog($pdo, $id) {
	
		//Create the array of `$parameters` for use in the `query` function
		$parameters = [':id' => $id];
	
	
		//call the query function and provide the `$parameters` array
		$query = $pdo->prepare('SELECT * FROM `blog` INNER JOIN `author`
		ON `authorid` = `author`.`id`  WHERE `blog`.`id` = :id', $parameters);

		$query->bindValue(':id', $id);
		$query->execute();

	
		return $query->fetch();
	}	
	
	
	$blog = wholeBlog($pdo, $_GET['id']);

	function allComments($pdo) {


			$query = $pdo->prepare('SELECT `comments`.`id`, `commtext`, `name`, `email`, `blogid`
				FROM `comments` INNER JOIN `author`
				ON `authorid` = `author`.`id` ');
			$query->execute();
			return $query->fetchAll();
	}

	$comments = allComments($pdo);


	if (isset($_POST['commtext'])) {

		// 1 currently represents the author id & blog id

		$sql = 'INSERT INTO `comments` (`commtext`, `commdate`, `authorid`, `blogId`) 
				VALUES (:commtext, CURDATE(), :authorId, :blogId)' ;

      	$stmt = $pdo->prepare($sql);

      	$stmt->bindValue(':commtext', $_POST['commtext']);
      	$stmt->bindValue(':authorId', 1 );
		$stmt->bindValue(':blogId', 1 );

      	$stmt->execute();
		
		//head back to the current page after inserting comment
		//THIS NO LONGER WORKS
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
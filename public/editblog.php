<?php
include __DIR__ . '/../includes/DatabaseConnection.php';
//include __DIR__ . '/../includes/DatabaseFunctions.php';

try {

	if (isset($_POST['blogheading'])) {
		$sql = 'UPDATE `blog` SET `authorId` = :authorId, 
									`blogheading` = :blogheading, 
									`blogtext` = :blogtext 
									WHERE `id` = :id';
		

		$stmt = $pdo->prepare($sql);

      	$stmt->bindValue(':blogheading', $_POST['blogheading']);
      	$stmt->bindValue(':blogtext', $_POST['blogtext']);
      	$stmt->bindValue(':authorId', 1 );
		$stmt->bindValue(':id', $_POST['id']);

      	$stmt->execute();
		
    	header('location: blogs.php');

	}
	else {
		
		function getBlog($pdo, $id) {
	
			$query = $pdo->prepare('SELECT * FROM `blog` WHERE `id` = :id');
			$query->bindValue(':id', $id);
			$query->execute();
			
		
			return $query->fetch();

		}

			$blog = getBlog($pdo, $_GET['id']);

			$title = 'Edit blog';

			ob_start();

			include  __DIR__ . '/../templates/editblog.html.php';

			$output = ob_get_clean();
	}
}
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';
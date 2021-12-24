<?php
function loadTemplate($templateFileName, $variables = []) {
	extract($variables);

	ob_start();
	include  __DIR__ . '/../templates/' . $templateFileName;

	return ob_get_clean();
}
try {
	include __DIR__ . '/../includes/DatabaseConnection.php';
	include __DIR__ . '/../classes/DatabaseTable.php';
	include __DIR__ . '/../classes/controllers/BlogController.php';

	$blogsTable = new DatabaseTable($pdo, 'blog', 'id');
	$authorsTable = new DatabaseTable($pdo, 'author', 'id');
	$commentsTable = new DatabaseTable($pdo, 'comment', 'id');
    $displayCommentsTable = new DatabaseTable($pdo, 'comment', 'commBlogId');

    $blogController = new BlogController($authorsTable, $blogsTable, $commentsTable, $displayCommentsTable);


	$action = $_GET['action'] ?? 'home';

	$page = $blogController->$action();

	$title = $page['title'];

	if (isset($page['variables'])) {
		$output = loadTemplate($page['template'], $page['variables']);
	}
	else {
		$output = loadTemplate($page['template']);
	}

}
catch (PDOException $e) {
	$title = 'An error has occurred';

	$output = 'Database error: ' . $e->getMessage() . ' in ' .
	$e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';
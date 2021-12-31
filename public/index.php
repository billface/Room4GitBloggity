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

	$blogsTable = new DatabaseTable($pdo, 'blog', 'id');
	$authorsTable = new DatabaseTable($pdo, 'author', 'id');
	$commentsTable = new DatabaseTable($pdo, 'comment', 'id');
    $displayCommentsTable = new DatabaseTable($pdo, 'comment', 'commBlogId');


	$route = ltrim(strtok($_SERVER['REQUEST_URI'], '?'), '/');

	if ($route == strtolower($route)) {
		
		if ($route === 'blog/list') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->list();
		}
		else if ($route === '') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->home();
		}
		else if ($route === 'blog/edit') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->edit();
		}
		else if ($route === 'blog/add') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->add();
		}
		else if ($route === 'blog/delete') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->delete();
		}
		else if ($route === 'blog/wholeblog') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->wholeblog();
		}
		else if ($route === 'blog/editcomment') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->editcomment();
		}
		else if ($route === 'blog/deletecomment') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->deletecomment();
		}
		else if ($route === 'register') {
			include __DIR__ . '/../classes/controllers/RegisterController.php';
			$controller = new RegisterController($authorsTable);
			$page = $controller->showForm();
		}
	}
	else {
		http_response_code(301);
		header('location: ' . strtolower($route));
	}

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
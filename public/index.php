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
	$pageTable = new DatabaseTable($pdo, 'page', 'id');

    //$blogController = new BlogController($authorsTable, $blogsTable, $commentsTable, $displayCommentsTable, $pageTable);
	//change this to page/home
	$route = $_GET['route'] ?? 'blog/home'; //if no route variable is set, use 'blog/home'


	if ($route == strtolower($route)) {

		if ($route === 'blog/list') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable, $pageTable);
			$page = $controller->list();
		}
		else if ($route === 'blog/home') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable, $pageTable);
			$page = $controller->home();
		}
		else if ($route === 'blog/about') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable, $pageTable);
			$page = $controller->about();
		}
		else if ($route === 'blog/events') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable, $pageTable);
			$page = $controller->events();
		}
		else if ($route === 'blog/shop') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable, $pageTable);
			$page = $controller->shop();
		}
		else if ($route === 'blog/edit') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable, $pageTable);
			$page = $controller->edit();
		}
		else if ($route === 'blog/delete') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable, $pageTable);
			$page = $controller->delete();
		}
		else if ($route === 'register') {
			include __DIR__ . '/../classes/controllers/RegisterController.php';
			$controller = new RegisterController($authorsTable);
			$page = $controller->showForm();
		}
}
else {
	http_response_code(301);
	header('location: index.php?route=' . strtolower($route));
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
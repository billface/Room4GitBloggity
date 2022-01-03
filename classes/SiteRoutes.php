<?php
class SiteRoutes {
    public function callAction($route)

    {
        include __DIR__ . '/../includes/DatabaseConnection.php';
	    include __DIR__ . '/../classes/DatabaseTable.php';

        $blogsTable = new DatabaseTable($pdo, 'blog', 'id');
	    $authorsTable = new DatabaseTable($pdo, 'author', 'id');
	    $commentsTable = new DatabaseTable($pdo, 'comment', 'id');
        $displayCommentsTable = new DatabaseTable($pdo, 'comment', 'commBlogId');   

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

        return $page;
    }
}
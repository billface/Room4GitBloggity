<?php
namespace Site;

class SiteRoutes {
    public function callAction($route)

    {
		include __DIR__ . '/../../includes/DatabaseConnection.php';

        $blogsTable = new \Ninja\DatabaseTable($pdo, 'blog', 'id');
	    $authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');
	    $commentsTable = new \Ninja\DatabaseTable($pdo, 'comment', 'id');
        $displayCommentsTable = new \Ninja\DatabaseTable($pdo, 'comment', 'commBlogId');   

        if ($route === 'blog/list') {
			$controller = new \Site\Controllers\Blog($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->list();
		}
		else if ($route === '') {
			$controller = new \Site\Controllers\Blog($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->home();
		}
		else if ($route === 'blog/edit') {
			$controller = new \Site\Controllers\Blog($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->edit();
		}
		else if ($route === 'blog/add') {
			$controller = new \Site\Controllers\Blog($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->add();
		}
		else if ($route === 'blog/delete') {
			$controller = new \Site\Controllers\Blog($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->delete();
		}
		else if ($route === 'blog/wholeblog') {
			$controller = new \Site\Controllers\Blog($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->wholeblog();
		}
		else if ($route === 'blog/editcomment') {
			$controller = new \Site\Controllers\Blog($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->editcomment();
		}
		else if ($route === 'blog/deletecomment') {
			$controller = new \Site\Controllers\Blog($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->deletecomment();
		}
		else if ($route === 'register') {
			$controller = new \Site\Controllers\Register($authorsTable);
			$page = $controller->showForm();
		}

        return $page;
    }
}
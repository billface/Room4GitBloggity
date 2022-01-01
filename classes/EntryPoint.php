<?php
class EntryPoint {
	private $route;

	public function __construct($route) {
		$this->route = $route;
		$this->checkUrl();
	}

	private function checkUrl() {
		if ($this->route !== strtolower($this->route)) {
			http_response_code(301);
			header('location: ' . strtolower($this->route));
		}
	}

    private function loadTemplate($templateFileName, $variables = []) {
		extract($variables);

		ob_start();
		include  __DIR__ . '/../templates/' . $templateFileName;

		return ob_get_clean();
	}

    private function callAction() {
        include __DIR__ . '/../includes/DatabaseConnection.php';
	    include __DIR__ . '/../classes/DatabaseTable.php';

        $blogsTable = new DatabaseTable($pdo, 'blog', 'id');
	    $authorsTable = new DatabaseTable($pdo, 'author', 'id');
	    $commentsTable = new DatabaseTable($pdo, 'comment', 'id');
        $displayCommentsTable = new DatabaseTable($pdo, 'comment', 'commBlogId');   

        if ($this->route === 'blog/list') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->list();
		}
		else if ($this->route === '') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->home();
		}
		else if ($this->route === 'blog/edit') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->edit();
		}
		else if ($this->route === 'blog/add') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->add();
		}
		else if ($this->route === 'blog/delete') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->delete();
		}
		else if ($this->route === 'blog/wholeblog') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->wholeblog();
		}
		else if ($this->route === 'blog/editcomment') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->editcomment();
		}
		else if ($this->route === 'blog/deletecomment') {
			include __DIR__ . '/../classes/controllers/BlogController.php';
			$controller = new BlogController($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
			$page = $controller->deletecomment();
		}
		else if ($this->route === 'register') {
			include __DIR__ . '/../classes/controllers/RegisterController.php';
			$controller = new RegisterController($authorsTable);
			$page = $controller->showForm();
		}

        return $page;
    }

    public function run() {

		$page = $this->callAction();

		$title = $page['title'];

		if (isset($page['variables'])) {
			$output = $this->loadTemplate($page['template'], $page['variables']);
		}
		else {
			$output = $this->loadTemplate($page['template']);
		}

		include  __DIR__ . '/../templates/layout.html.php';
	}
}

<?php
namespace Site;

class SiteRoutes implements \Ninja\Routes {
	private $authorsTable;
	private $blogsTable;
	private $commentsTable;
	private $displayCommentsTable;
	private $authentication;

	public function __construct() {
		include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->blogsTable = new \Ninja\DatabaseTable($pdo, 'blog', 'id');
	    $this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');
	    $this->commentsTable = new \Ninja\DatabaseTable($pdo, 'comment', 'id');
        $this->displayCommentsTable = new \Ninja\DatabaseTable($pdo, 'comment', 'commBlogId');   
		$this->authentication = new \Ninja\Authentication($this->authorsTable, 'email', 'password');
	
	}


		public function getRoutes() : array {

			$blogController = new \Site\Controllers\Blog($this->blogsTable, $this->authorsTable, $this->commentsTable, $this->displayCommentsTable);
			$authorController = new \Site\Controllers\Register($this->authorsTable);
			$loginController = new \Site\Controllers\Login();

		
			$routes = [
				'author/register' => [
					'GET' => [
						'controller' => $authorController,
						'action' => 'registrationForm'
					],
					'POST' => [
						'controller' => $authorController,
						'action' => 'registerUser'
					]
				],
				'author/success' => [
					'GET' => [
						'controller' => $authorController,
						'action' => 'success'
					]
				],
				'blog/edit' => [
					'POST' => [
						'controller' => $blogController,
						'action' => 'saveEdit'
					],
					'GET' => [
						'controller' => $blogController,
						'action' => 'displayEdit'
					],
					'login' => true

				],
				'blog/delete' => [
					'POST' => [
						'controller' => $blogController,
						'action' => 'delete'
					],
					'login' => true

				],
				'blog/list' => [
					'GET' => [
						'controller' => $blogController,
						'action' => 'list'
					]
				],
				'' => [
					'GET' => [
						'controller' => $blogController,
						'action' => 'home'
					]
				],
				'blog/addpage' => [
					'GET' => [
						'controller' => $blogController,
						'action' => 'addpage'
					],
					'login' => true

				],
				'blog/add' => [
					'POST' => [
						'controller' => $blogController,
						'action' => 'add'
					],
					'login' => true

				],
				'blog/wholeblog' => [
					'GET' => [
						'controller' => $blogController,
						'action' => 'wholeblog'
					]
				],
				'blog/addcomment' => [
					'POST' => [
						'controller' => $blogController,
						'action' => 'addcomment'
					],
					'login' => true

				],
				'blog/editcomment' => [
					'POST' => [
						'controller' => $blogController,
						'action' => 'editcomment'
					],
					'login' => true

				],
				'blog/deletecomment' => [
					'POST' => [
						'controller' => $blogController,
						'action' => 'deletecomment'
					],
					'login' => true

				],
				'login/error' => [
					'GET' => [
						'controller' => $loginController,
						'action' => 'error'
					]
				]
			];

			return $routes;
		}

	public function getAuthentication(): \Ninja\Authentication {
		return $this->authentication;
	}

}
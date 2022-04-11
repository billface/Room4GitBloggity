<?php
namespace Site;

class SiteRoutes implements \Ninja\Routes {
	private $authorsTable;
	private $blogsTable;
	private $authentication;
	private $commentsTable;
	private $displayCommentsTable;
	private $siteTabe;
	private $eventsTable;
	private $itemsTable;

	

	public function __construct() {
		include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->blogsTable = new \Ninja\DatabaseTable($pdo, 'blog', 'id');
	    $this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');
		$this->authentication = new \Ninja\Authentication($this->authorsTable, 'email', 'password');
	    $this->commentsTable = new \Ninja\DatabaseTable($pdo, 'comment', 'id');
        $this->displayCommentsTable = new \Ninja\DatabaseTable($pdo, 'comment', 'commBlogId');  
		$this->siteTable = new \Ninja\DatabaseTable($pdo, 'site', 'id');   
		$this->eventsTable = new \Ninja\DatabaseTable($pdo, 'event', 'id');    
		$this->itemsTable = new \Ninja\DatabaseTable($pdo, 'item', 'id');    

	}


		public function getRoutes() : array {

			$blogController = new \Site\Controllers\Blog($this->blogsTable, $this->authorsTable, $this->authentication, $this->commentsTable, $this->displayCommentsTable);
			$authorController = new \Site\Controllers\Register($this->authorsTable);
			$siteController = new \Site\Controllers\Site($this->siteTable);
			$eventController = new \Site\Controllers\Event($this->eventsTable, $this->authorsTable, $this->authentication);
			$itemController = new \Site\Controllers\Item($this->itemsTable, $this->authorsTable, $this->authentication);
			$loginController = new \Site\Controllers\Login($this->authentication);

		
			$routes = [
				'' => [
					'GET' => [
						'controller' => $blogController,
						'action' => 'home'
					]
				],
				'site/about' => [
					'GET' => [
						'controller' => $siteController,
						'action' => 'about'
					]
				],
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
				'login/success' => [
					'GET' => [
						'controller' => $loginController,
						'action' => 'success'
					],
					'login' => true
				],
				'login' => [
					'GET' => [
						'controller' => $loginController,
						'action' => 'loginForm'
					],
					'POST' => [
						'controller' => $loginController,
						'action' => 'processLogin'
					]
				],
				'logout' => [
					'GET' => [
						'controller' => $loginController,
						'action' => 'logout'
					]
				],
				'login/error' => [
					'GET' => [
						'controller' => $loginController,
						'action' => 'error'
					]
				],
				'event/list' => [
					'GET' => [
						'controller' => $eventController,
						'action' => 'list'
					]
				],
				'event/edit' => [
					'POST' => [
						'controller' => $eventController,
						'action' => 'saveEdit'
					],
					'GET' => [
						'controller' => $eventController,
						'action' => 'displayEdit'
					],
					'login' => true

				],
				'event/delete' => [
					'POST' => [
						'controller' => $eventController,
						'action' => 'delete'
					],
					'login' => true

				],
				'event/addpage' => [
					'GET' => [
						'controller' => $eventController,
						'action' => 'addpage'
					],
					'login' => true
				],
				'event/add' => [
					'POST' => [
						'controller' => $eventController,
						'action' => 'add'
					],
					'login' => true
				],
				'item/list' => [
					'GET' => [
						'controller' => $itemController,
						'action' => 'list'
					]
				],
				'item/addpage' => [
					'GET' => [
						'controller' => $itemController,
						'action' => 'addpage'
					],
					'login' => true
				],
				'item/add' => [
					'POST' => [
						'controller' => $itemController,
						'action' => 'add'
					],
					'login' => true
				],
				'item/edit' => [
					'POST' => [
						'controller' => $itemController,
						'action' => 'saveEdit'
					],
					'GET' => [
						'controller' => $itemController,
						'action' => 'displayEdit'
					],
					'login' => true

				],
				'item/delete' => [
					'POST' => [
						'controller' => $itemController,
						'action' => 'delete'
					],
					'login' => true

				],

			];

			return $routes;
		}

	public function getAuthentication(): \Ninja\Authentication {
		return $this->authentication;
	}

}
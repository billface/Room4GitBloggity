<?php
namespace Site;

class SiteRoutes implements \Ninja\Routes {
	private $authorsTable;
	private $blogsTable;
	private $commentsTable;
	private $displayCommentsTable;
	private $pagesTable;
	private $eventsTable;
	private $itemsTable;
	private $categoriesTable;
	private $blogCategoriesTable;
	private $authentication;



	

	public function __construct() {
		include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->blogsTable = new \Ninja\DatabaseTable($pdo, 'blog', 'id', '\Site\Entity\Blog', [&$this->authorsTable, &$this->blogCategoriesTable]);
		$this->pagesTable = new \Ninja\DatabaseTable($pdo, 'page', 'id', '\Site\Entity\Page', [&$this->authorsTable]);   
		$this->eventsTable = new \Ninja\DatabaseTable($pdo, 'event', 'id', '\Site\Entity\Event', [&$this->authorsTable]);    
		$this->itemsTable = new \Ninja\DatabaseTable($pdo, 'item', 'id', '\Site\Entity\Item', [&$this->authorsTable]);    
		$this->commentsTable = new \Ninja\DatabaseTable($pdo, 'comment', 'id', '\Site\Entity\Comment', [&$this->authorsTable]);
		$this->displayCommentsTable = new \Ninja\DatabaseTable($pdo, 'comment', 'commBlogId', '\Site\Entity\Comment', [&$this->authorsTable]); 
		$this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id', '\Site\Entity\Author', [&$this->blogsTable, &$this->pagesTable, &$this->eventsTable, &$this->itemsTable, &$this->commentsTable]);
		$this->categoriesTable = new \Ninja\DatabaseTable($pdo, 'category', 'id', '\Site\Entity\Category', [&$this->blogsTable, &$this->blogCategoriesTable]);
		$this->blogCategoriesTable = new \Ninja\DatabaseTable($pdo, 'blog_category', 'categoryId');
		$this->authentication = new \Ninja\Authentication($this->authorsTable, 'email', 'password');
         
  
	
	}


		public function getRoutes() : array {

			$blogController = new \Site\Controllers\Blog($this->blogsTable, $this->authorsTable, $this->commentsTable, $this->displayCommentsTable, $this->pagesTable, $this->eventsTable, $this->itemsTable, $this->categoriesTable, $this->authentication);
			$pageController = new \Site\Controllers\Page($this->pagesTable, $this->authorsTable, $this->authentication, $this->blogsTable, $this->eventsTable, $this->itemsTable, $this->commentsTable);
			$eventController = new \Site\Controllers\Event($this->eventsTable, $this->authorsTable, $this->authentication, $this->blogsTable, $this->pagesTable, $this->commentsTable, $this->itemsTable);
			$itemController = new \Site\Controllers\Item($this->itemsTable, $this->authorsTable, $this->authentication, $this->blogsTable, $this->pagesTable, $this->commentsTable, $this->eventsTable);
			$authorController = new \Site\Controllers\Register($this->authorsTable);
			$loginController = new \Site\Controllers\Login($this->authentication);
			$categoryController = new \Site\Controllers\Category($this->categoriesTable);

		
			$routes = [
				'' => [
					'GET' => [
						'controller' => $pageController,
						'action' => 'home'
					]
				],
				'page/about' => [
					'GET' => [
						'controller' => $pageController,
						'action' => 'about'
					]
				], 
				'page/admin' => [
					'GET' => [
						'controller' => $pageController,
						'action' => 'admin'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER
				],
				'page/list' => [
					'GET' => [
						'controller' => $pageController,
						'action' => 'list'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::GOD

				],
				'page/edit' => [
					'POST' => [
						'controller' => $pageController,
						'action' => 'saveEdit'
					],
					'GET' => [
						'controller' => $pageController,
						'action' => 'displayEdit'
					],
					'login' => true
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
				'author/permissions' => [
					'GET' => [
						'controller' => $authorController,
						'action' => 'permissions'
					],
					'POST' => [
						'controller' => $authorController,
						'action' => 'savePermissions'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::GOD

				],
				'author/list' => [
					'GET' => [
						'controller' => $authorController,
						'action' => 'list'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::GOD

				],
				'blog/list' => [
					'GET' => [
						'controller' => $blogController,
						'action' => 'list'
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
				'blog/addpage' => [
					'GET' => [
						'controller' => $blogController,
						'action' => 'addpage'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER


				],
				'blog/add' => [
					'POST' => [
						'controller' => $blogController,
						'action' => 'add'
					],
					'login' => true,


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
				'login/permissionserror' => [
					'GET' => [
						'controller' => $loginController,
						'action' => 'permissionsError'
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
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER

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
				'item/addpage' => [
					'GET' => [
						'controller' => $itemController,
						'action' => 'addpage'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER

				],
				'item/add' => [
					'POST' => [
						'controller' => $itemController,
						'action' => 'add'
					],
					'login' => true

				],
				'category/edit' => [
					'POST' => [
						'controller' => $categoryController,
						'action' => 'saveEdit'
					],
					'GET' => [
						'controller' => $categoryController,
						'action' => 'edit'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER

				],
				'category/delete' => [
					'POST' => [
						'controller' => $categoryController,
						'action' => 'delete'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER

				],
				'category/list' => [
					'GET' => [
						'controller' => $categoryController,
						'action' => 'list'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER

				]
			];

			return $routes;
		}

	public function getAuthentication(): \Ninja\Authentication {
		return $this->authentication;
	}

	public function checkPermission($permission): bool {
		$user = $this->authentication->getUser();

		if ($user && $user->hasPermission($permission)) {
			return true;
		} else {
			return false;
		}
	}

}
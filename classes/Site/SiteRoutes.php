<?php
namespace Site;

class SiteRoutes implements \Ninja\Routes {
	private $authorsTable;
	private $blogsTable;
	private $authentication;
	private $commentsTable;
	private $displayCommentsTable;
	private $pagesTable;
	private $eventsTable;
	private $itemsTable;
	private $blogCatsTable;
	private $blogCatJoinTable;
	private $itemSizesTable;
	private $itemSizeJoinTable;
	private $itemDescsTable;
	private $itemDescJoinTable;



	public function __construct() {
		include __DIR__ . '/../../includes/DatabaseConnection.php';

        $this->blogsTable = new \Ninja\DatabaseTable($pdo, 'blog', 'id', '\Site\Entity\Blog', [&$this->authorsTable, &$this->blogCatJoinTable]);
		$this->pagesTable = new \Ninja\DatabaseTable($pdo, 'page', 'id', '\Site\Entity\Page', [&$this->authorsTable]);   
		$this->eventsTable = new \Ninja\DatabaseTable($pdo, 'event', 'id', '\Site\Entity\Event', [&$this->authorsTable]);    
		$this->itemsTable = new \Ninja\DatabaseTable($pdo, 'item', 'id', '\Site\Entity\Item', [&$this->authorsTable, &$this->itemSizeJoinTable, &$this->itemDescJoinTable]);
		$this->commentsTable = new \Ninja\DatabaseTable($pdo, 'comment', 'id', '\Site\Entity\Comment', [&$this->authorsTable]);
		$this->displayCommentsTable = new \Ninja\DatabaseTable($pdo, 'comment', 'commBlogId', '\Site\Entity\Comment', [&$this->authorsTable]); 
		$this->authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id', '\Site\Entity\Author', [&$this->blogsTable, &$this->pagesTable, &$this->eventsTable, &$this->commentsTable, &$this->itemsTable]);
		//blogCatsTable needed added functionality to list blogs by category
		$this->blogCatsTable = new \Ninja\DatabaseTable($pdo, 'blogcat', 'id', '\Site\Entity\BlogCat', [&$this->blogsTable, &$this->blogCatJoinTable]);
		$this->blogCatJoinTable = new \Ninja\DatabaseTable($pdo, 'blog_cat_join', 'categoryId');
		$this->itemSizesTable = new \Ninja\DatabaseTable($pdo, 'itemsize', 'id' );
		$this->itemSizeJoinTable = new \Ninja\DatabaseTable($pdo, 'item_size_join', 'sizeId');
		$this->itemDescsTable = new \Ninja\DatabaseTable($pdo, 'itemdesc', 'id');
		$this->itemDescJoinTable = new \Ninja\DatabaseTable($pdo, 'item_desc_join', 'descId');
		$this->authentication = new \Ninja\Authentication($this->authorsTable, 'email', 'password');
         
  
	
	}


		public function getRoutes() : array {
			//the order of arguments is important. most specifically the possition of $this->authentication
			$blogController = new \Site\Controllers\Blog($this->blogsTable, $this->authorsTable, $this->commentsTable, $this->displayCommentsTable, $this->pagesTable, $this->eventsTable, $this->itemsTable, $this->blogCatsTable, $this->authentication);
			$authorController = new \Site\Controllers\Register($this->authorsTable);
			$pageController = new \Site\Controllers\Page($this->pagesTable, $this->authorsTable, $this->blogsTable, $this->eventsTable, $this->commentsTable, $this->itemsTable, $this->authentication);
			$eventController = new \Site\Controllers\Event($this->eventsTable, $this->authorsTable, $this->blogsTable, $this->pagesTable, $this->commentsTable, $this->itemsTable, $this->authentication);
			$itemController = new \Site\Controllers\Item($this->itemsTable, $this->itemSizesTable, $this->itemDescsTable, $this->authorsTable, $this->blogsTable, $this->pagesTable, $this->commentsTable, $this->eventsTable, $this->authentication);
			$loginController = new \Site\Controllers\Login($this->authentication);
			$blogCatController = new \Site\Controllers\BlogCat($this->blogCatsTable);
			$itemSizeController = new \Site\Controllers\ItemSize($this->itemSizesTable);
			$itemDescController = new \Site\Controllers\ItemDesc($this->itemDescsTable);


		
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
					'permissions' => \Site\Entity\Author::SUPERUSER
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
						'action' => 'addOrEdit'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER


				],
				'blog/delete' => [
					'POST' => [
						'controller' => $blogController,
						'action' => 'delete'
					],
					'login' => true

				],
				'blog/wholeblog' => [
					'GET' => [
						'controller' => $blogController,
						'action' => 'wholeblog'
					]
				],
				'blog/editcomment' => [
					'POST' => [
						'controller' => $blogController,
						'action' => 'AddOrEditComment'
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
						'action' => 'addOrEdit'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER

				],
				'event/delete' => [
					'POST' => [
						'controller' => $eventController,
						'action' => 'delete'
					],
					'login' => true

				],
				'blogcat/edit' => [
					'POST' => [
						'controller' => $blogCatController,
						'action' => 'saveEdit'
					],
					'GET' => [
						'controller' => $blogCatController,
						'action' => 'edit'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER
				],
				'blogcat/delete' => [
					'POST' => [
						'controller' => $blogCatController,
						'action' => 'delete'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER
				],
				'blogcat/list' => [
					'GET' => [
						'controller' => $blogCatController,
						'action' => 'list'
					],
					'login' => true
				],
				'item/list' => [
					'GET' => [
						'controller' => $itemController,
						'action' => 'list',
					]
				],
				'item/edit' => [
					'POST' => [
						'controller' => $itemController,
						'action' => 'saveEdit'
					],
					'GET' => [
						'controller' => $itemController,
						'action' => 'addOrEdit'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER
				],
				'item/delete' => [
					'POST' => [
						'controller' => $itemController,
						'action' => 'delete'
					],
					'login' => true

				],
				'item/buy' => [
					'POST' => [
						'controller' => $itemController,
						'action' => 'buy'
					],

				],
				'item/remove' => [
					'GET' => [
						'controller' => $itemController,
						'action' => 'remove'
					]
				],
				'item/success' => [
					'GET' => [
						'controller' => $itemController,
						'action' => 'success'
					]
				],
				'item/failure' => [
					'GET' => [
						'controller' => $itemController,
						'action' => 'failure'
					]
				],
				'itemsize/edit' => [
					'POST' => [
						'controller' => $itemSizeController,
						'action' => 'saveEdit'
					],
					'GET' => [
						'controller' => $itemSizeController,
						'action' => 'edit'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER

				],
				'itemsize/delete' => [
					'POST' => [
						'controller' => $itemSizeController,
						'action' => 'delete'
					],
					'login' => true
				],
				'itemsize/list' => [
					'GET' => [
						'controller' => $itemSizeController,
						'action' => 'list'
					],
					'login' => true
				],
				'itemdesc/edit' => [
					'POST' => [
						'controller' => $itemDescController,
						'action' => 'saveEdit'
					],
					'GET' => [
						'controller' => $itemDescController,
						'action' => 'edit'
					],
					'login' => true,
					'permissions' => \Site\Entity\Author::SUPERUSER
				],
				'itemdesc/delete' => [
					'POST' => [
						'controller' => $itemDescController,
						'action' => 'delete'
					],
					'login' => true
				],
				'itemdesc/list' => [
					'GET' => [
						'controller' => $itemDescController,
						'action' => 'list'
					],
					'login' => true
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
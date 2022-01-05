<?php
namespace Site;

class SiteRoutes implements \Ninja\Routes {
	public function getRoutes() 

    {
		include __DIR__ . '/../../includes/DatabaseConnection.php';

        $blogsTable = new \Ninja\DatabaseTable($pdo, 'blog', 'id');
	    $authorsTable = new \Ninja\DatabaseTable($pdo, 'author', 'id');
	    $commentsTable = new \Ninja\DatabaseTable($pdo, 'comment', 'id');
        $displayCommentsTable = new \Ninja\DatabaseTable($pdo, 'comment', 'commBlogId');   

		$blogController = new \Site\Controllers\Blog($blogsTable, $authorsTable, $commentsTable, $displayCommentsTable);
		$authorController = new \Site\Controllers\Register($authorsTable);

	
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
				]
			],
			'blog/delete' => [
				'POST' => [
					'controller' => $blogController,
					'action' => 'delete'
				]
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
				]
			],
			'blog/add' => [
				'POST' => [
					'controller' => $blogController,
					'action' => 'add'
				]
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
				]
			],
			'blog/editcomment' => [
				'POST' => [
					'controller' => $blogController,
					'action' => 'editcomment'
				]
			],
			'blog/deletecomment' => [
				'POST' => [
					'controller' => $blogController,
					'action' => 'deletecomment'
				]
			]
		];

		return $routes;
    }
}
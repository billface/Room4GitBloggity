<?php
namespace Site\Controllers;

class BlogCat {
	private $blogCatsTable;

	public function __construct(\Ninja\DatabaseTable $blogCatsTable) {
		$this->blogCatsTable = $blogCatsTable;
	}

	public function edit() {

		if (isset($_GET['id'])) {
			$category = $this->blogCatsTable->findById($_GET['id']);
		}

		$title = 'Edit Category';

		return ['template' => 'editcategory.html.php',
				'title' => $title,
				'variables' => [
					'category' => $category ?? null
				]
		];
	}

	public function saveEdit() {
		$category = $_POST['category'];

		$this->blogCatsTable->save($category);

		header('location: /blogcat/list');
	}

	public function list() {
		$categories = $this->blogCatsTable->findAll();

		$title = 'Blog Categories';

		return ['template' => 'blogcats.html.php', 
			'title' => $title, 
			'variables' => [
			    'categories' => $categories
			  ]
		];
	}

	public function delete() {
		$this->categoriesTable->delete($_POST['id']);

		header('location: /category/list'); 
	}
}
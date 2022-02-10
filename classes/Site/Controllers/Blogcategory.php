<?php
namespace Site\Controllers;

class Blogcategory {
	private $blogCategoriesTable;

	public function __construct(\Ninja\DatabaseTable $blogCategoriesTable) {
		$this->blogCategoriesTable = $blogCategoriesTable;
	}

	public function edit() {

		if (isset($_GET['id'])) {
			$blogCategory = $this->blogCategoriesTable->findById($_GET['id']);
		}

		$title = 'Edit Category';

		return ['template' => 'editblogcategory.html.php',
				'title' => $title,
				'variables' => [
					'blogCategory' => $blogCategory ?? null
				]
		];
	}

	public function saveEdit() {
		$blogCategory = $_POST['blogCategory'];

		$this->blogCategoriesTable->save($blogCategory);

		header('location: /blogcategory/list');
	}

	public function list() {
		$blogCategories = $this->blogCategoriesTable->findAll();

		$title = 'Blog Categories';

		return ['template' => 'blogcategories.html.php', 
			'title' => $title, 
			'variables' => [
			    'blogCategories' => $blogCategories
			  ]
		];
	}

	public function delete() {
		$this->blogCategoriesTable->delete($_POST['id']);

		header('location: /blogcategory/list'); 
	}
}
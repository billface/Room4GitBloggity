<?php
namespace Site\Entity;

class Blog {
	public $id;
	public $authorId;
	public $blogdate;
	public $blogtext;
	private $authorsTable;
	private $author;
	private $blogCategoriesTable;



	public function __construct(\Ninja\DatabaseTable $authorsTable, \Ninja\DatabaseTable $blogCategoriesTable) {
		$this->authorsTable = $authorsTable;
		$this->blogCategoriesTable = $blogCategoriesTable;

	}

	public function getAuthor() {
		if (empty($this->author)) {
			$this->author = $this->authorsTable->findById($this->authorId);
		}
		
		return $this->author;	
	}
	public function addCategory($categoryId) {
		$blogCat = ['blogId' => $this->id, 'categoryId' => $categoryId];

		$this->blogCategoriesTable->save($blogCat);
	}
}
<?php
namespace Site\Entity;

class Blog {
	public $id;
	public $authorId;
	public $blogdate;
	public $blogtext;
	private $authorsTable;
	private $author;
	private $blogJoinCategoriesTable;



	public function __construct(\Ninja\DatabaseTable $authorsTable, \Ninja\DatabaseTable $blogJoinCategoriesTable) {
		$this->authorsTable = $authorsTable;
		$this->blogJoinCategoriesTable = $blogJoinCategoriesTable;
	}

	public function getAuthor() {
		if (empty($this->author)) {
			$this->author = $this->authorsTable->findById($this->authorId);
		}
		
		return $this->author;	}
	
	public function addBlogCategory($blogCategoryId) {
		$blogCat = ['blogId' => $this->id, 'blogCategoryId' => $blogCategoryId];

		$this->blogJoinCategoriesTable->save($blogCat);
	}
}
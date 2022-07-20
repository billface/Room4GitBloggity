<?php
namespace Site\Entity;

class Blog {
	public $id;
	public $authorId;
	public $blogdate;
	public $blogtext;
	private $authorsTable;
	private $author;
	private $blogCatJoinTable;


	public function __construct(\Ninja\DatabaseTable $authorsTable, \Ninja\DatabaseTable $blogCatJoinTable) {
		$this->authorsTable = $authorsTable;
		$this->blogCatJoinTable = $blogCatJoinTable;

	}

	public function getAuthor() {
		if (empty($this->author)) {
			$this->author = $this->authorsTable->findById($this->authorId);
		}
		
		return $this->author;	
	}

	public function addCategory($categoryId) {
		$blogCat = ['blogId' => $this->id, 'categoryId' => $categoryId];

		$this->blogCatJoinTable->save($blogCat);
	}
	public function hasCategory($categoryId) {
		$blogCategories = $this->blogCatJoinTable->find('blogId', $this->id);

		foreach ($blogCategories as $blogCategory) {
			if ($blogCategory->categoryId == $categoryId) {
				return true;
			}
		}
	}
	public function clearCategories() {
		$this->blogCatJoinTable->deleteWhere('blogId', $this->id);
	}
}
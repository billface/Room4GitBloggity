<?php
namespace Site\Entity;
use \Ninja\DatabaseTable;


//see pg529 (pdf 390)

class Author {
	public $id;
	public $name;
	public $email;
	public $password;
    private $blogsTable;
	private $pagesTable;


	public function __construct(DatabaseTable $blogTable, DatabaseTable $pagesTable) {
		$this->blogsTable = $blogTable;
		$this->pagesTable = $pagesTable;
	}

	public function getblogs() {
		return $this->blogsTable->find('authorId', $this->id);
	}

	public function getPages() {
		return $this->pagesTable->find('authorId', $this->id);
	}

    public function addBlog($blog) {

		$blog['authorId'] = $this->id;

		$this->blogsTable->save($blog);
	}

	public function addPage($page) {

		$blog['authorId'] = $this->id;

		$this->pagesTable->save($page);
	}
}
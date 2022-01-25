<?php
namespace Site\Entity;

//see pg529 (pdf 390)

class Author {
	public $id;
	public $name;
	public $email;
	public $password;
    private $blogsTable;

	public function __construct(\Ninja\DatabaseTable $blogTable) {
		$this->blogsTable = $blogTable;
	}

	public function getblogs() {
		return $this->blogsTable->find('authorId', $this->id);
	}

    public function addBlog($blog) {

		$blog['authorId'] = $this->id;

		$this->blogsTable->save($blog);
	}
}
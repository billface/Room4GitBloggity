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
	private $siteTable;


	public function __construct(DatabaseTable $blogTable, DatabaseTable $siteTable) {
		$this->blogsTable = $blogTable;
		$this->siteTable = $siteTable;
	}

	public function getblogs() {
		return $this->blogsTable->find('authorId', $this->id);
	}

	public function getSites() {
		return $this->siteTable->find('authorId', $this->id);
	}

    public function addBlog($blog) {

		$blog['authorId'] = $this->id;

		$this->blogsTable->save($blog);
	}

	public function addSite($site) {

		$blog['authorId'] = $this->id;

		$this->siteTable->save($site);
	}
}
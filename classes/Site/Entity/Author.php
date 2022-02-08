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
	private $eventsTable;



	public function __construct(DatabaseTable $blogsTable, DatabaseTable $pagesTable, DatabaseTable $eventsTable) {
		$this->blogsTable = $blogsTable; 
		$this->pagesTable = $pagesTable;
		$this->eventsTable = $eventsTable;

	}

	public function getBlogs() {
		return $this->blogsTable->find('authorId', $this->id);
	}

	public function getPages() {
		return $this->pagesTable->find('authorId', $this->id);
	}

	public function getEvents() {
		return $this->eventsTable->find('authorId', $this->id);
	}

    public function addBlog($blog) {

		$blog['authorId'] = $this->id;

		$this->blogsTable->save($blog);
	}

	public function addPage($page) {

		$page['authorId'] = $this->id;

		$this->pagesTable->save($page);
	}

	public function addEvent($event) {

		$event['authorId'] = $this->id;

		$this->eventsTable->save($event);
	}
}
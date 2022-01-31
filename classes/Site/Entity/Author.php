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
	private $eventsTable;


	public function __construct(DatabaseTable $blogTable, DatabaseTable $eventsTable) {
		$this->blogsTable = $blogTable;
		$this->eventsTable = $eventsTable;

	}

	public function getBlogs() {
		return $this->blogsTable->find('authorId', $this->id);
	}
	public function getEvents() {
		return $this->eventsTable->find('authorId', $this->id);
	}

    public function addBlog($blog) {

		$blog['authorId'] = $this->id;

		$this->blogsTable->save($blog);
	}

	public function addEvent($event) {

		$event['authorId'] = $this->id;

		$this->eventsTable->save($event);
	}
}
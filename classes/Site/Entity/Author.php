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
	private $pagesTable;
	private $commentsTable;


	public function __construct(DatabaseTable $blogsTable, DatabaseTable $eventsTable, DatabaseTable $pagesTable, DatabaseTable $commentsTable) {
		$this->blogsTable = $blogsTable;
		$this->eventsTable = $eventsTable;
		$this->pagesTable = $pagesTable;
		$this->commentsTable = $commentsTable;
	}

	public function getBlogs() {
		return $this->blogsTable->find('authorId', $this->id);
	}
	public function getEvents() {
		return $this->eventsTable->find('authorId', $this->id);
	}
	public function getPages() {
		return $this->pagesTable->find('authorId', $this->id);
	}
	public function getComments() {
		return $this->commentsTable->find('authorId', $this->id);
	}
	

    public function addBlog($blog) {

		$blog['authorId'] = $this->id;

		$this->blogsTable->save($blog);
	}

	public function addEvent($event) {

		$event['authorId'] = $this->id;

		$this->eventsTable->save($event);
	}

	public function addPage($page) {

		$event['authorId'] = $this->id;

		$this->pagesTable->save($page);
	}

	public function addComment($comment) {

		$comment['authorId'] = $this->id;

		$this->commentsTable->save($comment);
	}
}
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
	private $commentsTable;
	private $itemsTable;

	



	public function __construct(DatabaseTable $blogsTable, DatabaseTable $pagesTable, DatabaseTable $eventsTable, DatabaseTable $commentsTable, DatabaseTable $itemsTable) {
		$this->blogsTable = $blogsTable; 
		$this->pagesTable = $pagesTable;
		$this->eventsTable = $eventsTable;
		$this->commentsTable = $commentsTable;
		$this->itemsTable = $itemsTable;
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

	public function getComments() {
		return $this->commentsTable->find('authorId', $this->id);
	}

	public function getItems() {
		return $this->itemsTable->find('authorId', $this->id);
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
	
	public function addComment($comment) {

		$comment['authorId'] = $this->id;

		$this->commentsTable->save($comment);
	}

	public function addItem($item) {

		$item['authorId'] = $this->id;

		$this->itemsTable->save($item);
	}

}
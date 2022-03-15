<?php
namespace Site\Entity;
use \Ninja\DatabaseTable;


//see pg529 (pdf 390)

class Author {

	const ADMIN = 1;
	const SUPERUSER = 2;
	const GOD = 4; 

	public $id;
	public $name;
	public $email;
	public $password;
    private $blogsTable;
	private $pagesTable;
	private $eventsTable;
	private $itemsTable;
	private $commentsTable;



	public function __construct(DatabaseTable $blogsTable, DatabaseTable $pagesTable, DatabaseTable $eventsTable, DatabaseTable $itemsTable,DatabaseTable $commentsTable) {
		$this->blogsTable = $blogsTable; 
		$this->pagesTable = $pagesTable;
		$this->eventsTable = $eventsTable;
		$this->itemsTable = $itemsTable;
		$this->commentsTable = $commentsTable;
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

	public function getItems() {
		return $this->itemsTable->find('authorId', $this->id);
	}

	public function getComments() {
		return $this->commentsTable->find('authorId', $this->id);
	}

    public function addBlog($blog) {

		$blog['authorId'] = $this->id;

		return $this->blogsTable->save($blog);
	}

	public function addPage($page) {

		$page['authorId'] = $this->id;

		return $this->pagesTable->save($page);
	}

	public function addEvent($event) {

		$event['authorId'] = $this->id;

		return $this->eventsTable->save($event);
	}

	public function addItem($item) {

		$item['authorId'] = $this->id;

		return $this->itemsTable->save($item);
	}
	
	public function addComment($comment) {

		$comment['authorId'] = $this->id;

		return $this->commentsTable->save($comment);
	}

	public function hasPermission($permission) {
		return $this->permissions & $permission;  
	}

}
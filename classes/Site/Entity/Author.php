<?php
//this file make author object. See book page 528
namespace Site\Entity;

//see pg529 (pdf 390)

class Author {
	public $id;
	public $name;
	public $email;
	public $password;
    private $blogsTable;
	private $eventsTable;

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

	

	public function getevents() {
		return $this->eventsTable->find('authorId', $this->id);
	}

    public function addEvent($event) {

		$event['authorId'] = $this->id;

		$this->eventsTable->save($event);
	}


}
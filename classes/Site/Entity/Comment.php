<?php
namespace Site\Entity;

class Comment {
	public $id;
	public $authorId;
	public $commentdate;
	public $commenttext;
	private $authorsTable;
	private $author;



	public function __construct(\Ninja\DatabaseTable $authorsTable) {
		$this->authorsTable = $authorsTable;
	}

	public function getAuthor() {
		if (empty($this->author)) {
			$this->author = $this->authorsTable->findById($this->authorId);
		}
		
		return $this->author;	}
}
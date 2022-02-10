<?php
namespace Site\Entity;

class Comment {
	public $id;
	public $authorId;
	public $commentdate;
	public $commenttext;
	private $authorsTable;

	public function __construct(\Ninja\DatabaseTable $authorsTable) {
		$this->authorsTable = $authorsTable;
	}

	public function getAuthor() {
		return $this->authorsTable->findById($this->authorId);
	}
}
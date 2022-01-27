<?php
namespace Site\Entity;

class Blog {
	public $id;
	public $authorId;
	public $blogdate;
	public $blogtext;
	private $authorsTable;

	public function __construct(\Ninja\DatabaseTable $authorsTable) {
		$this->authorsTable = $authorsTable;
	}

	public function getAuthor() {
		return $this->authorsTable->findById($this->authorId);
	}
}
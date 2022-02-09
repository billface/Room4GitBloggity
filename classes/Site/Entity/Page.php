<?php
namespace Site\Entity;

class Page {
	public $id;
	public $authorId;
	public $pagedate;
	public $pagetext;
	private $authorsTable;

	public function __construct(\Ninja\DatabaseTable $authorsTable) {
		$this->authorsTable = $authorsTable;
	}

	public function getAuthor() {
		return $this->authorsTable->findById($this->authorId);
	}
}
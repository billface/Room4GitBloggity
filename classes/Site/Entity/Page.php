<?php
namespace Site\Entity;

class Page {
	public $id;
	public $authorId;
	public $pagedate;
	public $pagetext;
	private $authorsTable;
	private $author;

	public function __construct(\Ninja\DatabaseTable $authorsTable) {
		$this->authorsTable = $authorsTable;
	}

	public function getAuthor() {
		if (empty($this->author)) {
			$this->author = $this->authorsTable->findById($this->authorId);
		}
		
		return $this->author;
	}
}
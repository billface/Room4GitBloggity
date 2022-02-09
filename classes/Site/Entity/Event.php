<?php
namespace Site\Entity;

class Event {
	public $id;
	public $authorId;
	public $eventdate;
	public $eventtext;
	private $authorsTable;

	public function __construct(\Ninja\DatabaseTable $authorsTable) {
		$this->authorsTable = $authorsTable;
	}

	public function getAuthor() {
		return $this->authorsTable->findById($this->authorId);
	}
}
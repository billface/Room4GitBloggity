<?php
namespace Site\Entity;

class Item {
	public $id;
	public $authorId;
	public $itemdate;
	public $itemtext;
	private $authorsTable;
	private $author;
	private $itemSizeJoinTable;

	public function __construct(\Ninja\DatabaseTable $authorsTable, \Ninja\DatabaseTable $itemSizeJoinTable) {
		$this->authorsTable = $authorsTable;
		$this->itemSizeJoinTable = $itemSizeJoinTable;

	}

	public function getAuthor() {
		if (empty($this->author)) {
			$this->author = $this->authorsTable->findById($this->authorId);
		}
		
		return $this->author;
	}

	public function addSize($sizeId) {
		$itemSiz = ['itemId' => $this->id, 'sizeId' => $sizeId];

		$this->itemSizeJoinTable->save($itemSiz);
	}
}
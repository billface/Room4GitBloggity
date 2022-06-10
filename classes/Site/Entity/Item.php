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
		$itemSize = ['itemId' => $this->id, 'sizeId' => $sizeId];

		$this->itemSizeJoinTable->save($itemSize);
	}

	public function hasSize($sizeId) {
		$itemJoinSizes = $this->itemSizeJoinTable->find('itemId', $this->id);

		foreach ($itemJoinSizes as $itemJoinSize) {
			if ($itemJoinSize->sizeId == $sizeId) {
				return true;
			}
		}
	}

	public function sizePresent($itemId) {
		$itemSizePresent = $this->itemSizeJoinTable->find('itemId', $this->id);
			return $itemSizePresent;
	}

	public function clearSizes() {
		$this->itemSizeJoinTable->deleteWhere('itemId', $this->id);
	}

}
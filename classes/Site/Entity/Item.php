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
	private $itemDescJoinTable;


	public function __construct(\Ninja\DatabaseTable $authorsTable, \Ninja\DatabaseTable $itemSizeJoinTable, \Ninja\DatabaseTable $itemDescJoinTable) {
		$this->authorsTable = $authorsTable;
		$this->itemSizeJoinTable = $itemSizeJoinTable;
		$this->itemDescJoinTable = $itemDescJoinTable;

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

	public function addDesc($descId) {
		$itemDesc = ['itemId' => $this->id, 'descId' => $descId];

		$this->itemDescJoinTable->save($itemDesc);
	}

	public function hasSize($sizeId) {
		$itemJoinSizes = $this->itemSizeJoinTable->find('itemId', $this->id);

		foreach ($itemJoinSizes as $itemJoinSize) {
			if ($itemJoinSize->sizeId == $sizeId) {
				return true;
			}
		}
	}

	public function hasDesc($descId) {
		$itemJoinDescs = $this->itemDescJoinTable->find('itemId', $this->id);

		foreach ($itemJoinDescs as $itemJoinDesc) {
			if ($itemJoinDesc->descId == $descId) {
				return true;
			}
		}
	}

	public function sizePresent($itemId) {
		$itemSizePresent = $this->itemSizeJoinTable->find('itemId', $this->id);
			return $itemSizePresent;
	}

	public function descPresent($itemId) {
		$itemDescPresent = $this->itemDescJoinTable->find('itemId', $this->id);
			return $itemDescPresent;
	}

	public function clearSizes() {
		$this->itemSizeJoinTable->deleteWhere('itemId', $this->id);
	}

	public function clearDescs() {
		$this->itemDescJoinTable->deleteWhere('itemId', $this->id);
	}

}
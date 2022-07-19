<?php
namespace Site\Controllers;

class ItemSize {
	private $itemSizesTable;

	public function __construct(\Ninja\DatabaseTable $itemSizesTable) {
		$this->itemSizesTable = $itemSizesTable;
	}

    public function edit() {

		if (isset($_GET['id'])) {
			$itemsize = $this->itemSizesTable->findById($_GET['id']);
		}

		$title = 'Edit Item Sizes';

		return ['template' => 'itemsizeedit.html.php',
				'title' => $title,
				'variables' => [
					'itemsize' => $itemsize ?? null
				]
		];
	}

    public function saveEdit() {
		$itemsize = $_POST['itemsize'];

		$this->itemSizesTable->save($itemsize);

		header('location: /itemsize/list');
	}

	public function list() {
		$itemsizes = $this->itemSizesTable->findAll();

		$title = 'Shop Item Sizes';

		return ['template' => 'itemsize.html.php', 
			'title' => $title, 
			'variables' => [
			    'itemsizes' => $itemsizes
			  ]
		];
	}

	public function delete() {
		$this->itemSizesTable->delete($_POST['id']);

		header('location: /itemsize/list'); 
	}
}
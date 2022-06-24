<?php
namespace Site\Controllers;

class ItemDesc {
	private $itemDescsTable;

	public function __construct(\Ninja\DatabaseTable $itemDescsTable) {
		$this->itemDescsTable = $itemDescsTable;
	}

    public function edit() {

		if (isset($_GET['id'])) {
			$itemdesc = $this->itemDescsTable->findById($_GET['id']);
		}

		$title = 'Edit Item Descriptions';

		return ['template' => 'itemdescedit.html.php',
				'title' => $title,
				'variables' => [
					'itemdesc' => $itemdesc ?? null
				]
		];
	}

    public function saveEdit() {
		$itemdesc = $_POST['itemdesc'];

		$this->itemDescsTable->save($itemdesc);

		header('location: /itemdesc/list');
	}

	public function list() {
		$itemdescs = $this->itemDescsTable->findAll();

		$title = 'Shop Item Descriptions';

		return ['template' => 'itemdesc.html.php', 
			'title' => $title, 
			'variables' => [
			    'itemdescs' => $itemdescs
			  ]
		];
	}

	public function delete() {
		$this->itemDescsTable->delete($_POST['id']);

		header('location: /itemdesc/list'); 
	}
}
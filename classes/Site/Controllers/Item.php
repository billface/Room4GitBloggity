<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Item {
    private $authorsTable;
    private $itemsTable;

	public function __construct(DatabaseTable $itemsTable, DatabaseTable $authorsTable, Authentication $authentication) {
        $this->authorsTable = $authorsTable;
        $this->itemsTable = $itemsTable;
        $this->authentication = $authentication;

	}

    public function list() {
        $result = $this->itemsTable->findAll();

        $items = [];
          foreach ($result as $item) {
            $author = $this->authorsTable->findById($item['authorId']);
      
            $items[] = [
                    'id' => $item['id'],
                    'itemHeading' => $item['itemHeading'],
                    'itemText' => $item['itemText'],
                    'itemPicture' => $item['itemPicture'],
                    'itemPrice' => $item['itemPrice'],
                    'itemShipping' => $item['itemShipping'],
                    'itemStock' => $item['itemStock'],
                    'name' => $author['name'],
                    'email' => $author['email'],
                    'authorId' => $author['id']

                ];
      
          }

        $title = 'Items List';

        $author = $this->authentication->getUser();


        return ['template' => 'items.html.php', 
				'title' => $title, 
				'variables' => [
						'items' => $items,
                        'userId' => $author['id'] ?? null

        					]
                            					
				];
        
    }

    public function delete() {

        $author = $this->authentication->getUser();

        $item = $this->itemsTable->findById($_POST['itemId']);

        if ($item['authorId'] != $author['id']) {
			return;
		}
		

        $this->itemsTable->delete($_POST['itemId']);
    
        header('location: /item/list');
    }

    public function saveEdit() {
        $author = $this->authentication->getUser();

        //added security from Ninja pg 493 PDF 363
        if (isset($_GET['id'])) {
            $item = $this->itemsTable->findById($_GET['id']);

            if ($item['authorId'] != $author['id']) {
                return;
            }
        }

        $item = $_POST['item'];
        //the above is from form, below is others
        $item['authorId'] = $author['id'];

        $this->itemsTable->save($item);

        header('location: /item/list');

    }

    public function displayEdit() {
            
        $author = $this->authentication->getUser();

        $item = $this->itemsTable->findById($_GET['id']);

        $title = 'Edit item';

        return ['template' => 'edititem.html.php', 
                'title' => $title,
                'variables' => [
                    'item' => $item,
                    'userId' => $author['id'] ?? null
                    ]
                ];
    }

    public function add() {
        $author = $this->authentication->getUser();

       //possible security flaw (see pg 493 PDF 363)

        $item = $_POST['item'];
        //the above is from form, below is others
        $item['authorId'] = $author['id'];

        $this->itemsTable->save($item);

        header('location: /item/list');
}

public function addpage() {

    $title = 'Add a new item';

    return ['template' => 'additem.html.php', 'title' => $title];

}

}
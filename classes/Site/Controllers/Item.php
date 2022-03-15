<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Item {
    private $itemsTable;
    private $authorsTable;
    private $pagesTable;
    private $blogsTable;
    private $commentsTable;
    private $eventsTable;

    

	public function __construct(DatabaseTable $itemsTable, DatabaseTable $authorsTable, Authentication $authentication, DatabaseTable $pagesTable, DatabaseTable $blogsTable, DatabaseTable $commentsTable, DatabaseTable $eventsTable) {
        $this->itemsTable = $itemsTable;
        $this->authorsTable = $authorsTable;
        $this->authentication = $authentication;
        $this->pagesTable = $pagesTable;
        $this->blogsTable = $blogsTable;
        $this->commentsTable = $commentsTable;
        $this->eventsTable = $eventsTable;


	}

    public function list() {
        $items = $this->itemsTable->findAll();

        $title = 'Items List';

        $author = $this->authentication->getUser();

        return ['template' => 'items.html.php', 
				'title' => $title, 
				'variables' => [
						'items' => $items,
                        'user' => $author //previously 'userId' => $author->id ?? null,
					]
				];
        
    }
    //checks auth and adds
    public function add() {
        $author = $this->authentication->getUser();

        $item = $_POST['item'];
        //the above is from form, below is others

        $author->addItem($item);

        header('location: /item/list');
    }
    //brings up form
    public function addpage() {

            $title = 'Add a new item';

            return ['template' => 'additem.html.php', 'title' => $title];
        
    }

    public function delete() {

        $author = $this->authentication->getUser();

        $item = $this->itemsTable->findById($_POST['itemId']);

        if ($item->authorId != $author->id) {
            return;
        }
        
        $this->itemsTable->delete($_POST['itemId']);
    
        header('location: /item/list');
    }

    public function saveEdit() {
        $author = $this->authentication->getUser();

        $item = $_POST['item'];
            
        //the above is from form, below is others

        $author->addItem($item);

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
                    'user' => $author 
                    ]
                ];
    }

}
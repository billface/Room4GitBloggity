<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Item {
    private $itemsTable;
    private $itemSizesTable;
    private $authorsTable;
    private $pagesTable;
    private $blogsTable;
    private $commentsTable;
    private $eventsTable;
    private $authentication;

	//the order of constucts is important. most specifically the position of $authentication vs SiteRoutes getRoutes()
	public function __construct(DatabaseTable $itemsTable,  DatabaseTable $itemSizesTable, DatabaseTable $authorsTable, DatabaseTable $pagesTable, DatabaseTable $blogsTable, DatabaseTable $commentsTable, DatabaseTable $eventsTable, Authentication $authentication) {
        $this->itemsTable = $itemsTable;
        $this->itemSizesTable = $itemSizesTable;
        $this->authorsTable = $authorsTable;
        $this->pagesTable = $pagesTable;
        $this->blogsTable = $blogsTable;
        $this->commentsTable = $commentsTable;
        $this->eventsTable = $eventsTable;
        $this->authentication = $authentication;
        

	}

    public function list() {
        $items = $this->itemsTable->findAll();
        $itemsizes = $this->itemSizesTable->findAll();


        if (empty($items)) {
            $emptyMessage = 'The shelves are bare';
        }

        $title = 'Items List';
        $metaDescription = 'The Shop';
        
        //hacked c&p code
        if(!empty($_SESSION["cart"])){
            $total = 0;
            foreach ($_SESSION["cart"] as $key => $value) {
               
                $total = $total + ($value["item_quantity"] * $value["item_price"]);
            }
        } else { 
            $total=0; 
        }

        $_SESSION["checkoutTotal"] = $total;

        //end

        $author = $this->authentication->getUser();
        $paypal = true;

        return ['template' => 'items.html.php', 
				'title' => $title,
                'paypal' => $paypal,
                'metaDescription' => $metaDescription,
				'variables' => [
						'items' => $items,
                        'itemsizes' => $itemsizes,
                        'userId' => $author->id ?? null,
                        'emptyMessage' => $emptyMessage ?? null,
                        'total' => $total
        				]    					
				];
        
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

        //upload file if it has been selected
        if ($_FILES['file']['size'] > 0){
            $return = $this->itemsTable->upload($item['itemPicture']);
            $item['itemFileName'] = $return['fileNameNew'];
            //end upload files and handle any errors
                if ($return['message'] == '') {
                    $itemEntity = $author->addItem($item);
                    $itemEntity->clearSizes();
                    foreach ($_POST['itemsize'] as $sizeId) {
                        $itemEntity->addSize($sizeId);
                    }
                    unset($_SESSION['item']);
                    header('location: /item/list');
                } else {
                    $_SESSION['item'] = $item;
                    $_SESSION['itemErrorMessage'] = $return['message'];
                    header('location: /item/addpage');
                }
        // if no file is selected submit the rest of the form
        } else {
            
            $itemEntity = $author->addItem($item);
            $itemEntity->clearSizes();
            foreach ($_POST['itemsize'] as $sizeId) {
                $itemEntity->addSize($sizeId);
            }
            header('location: /item/list');

        }

    }

    public function addOrEdit() {
            
        $author = $this->authentication->getUser();
        $itemsizes = $this->itemSizesTable->findAll();

        if (isset($_GET['id'])) {
            $item = $this->itemsTable->findById($_GET['id']);			
		}

        $title = 'Edit item';
        $metaRobots = 'noindex';

        return ['template' => 'itemedit.html.php', 
                'title' => $title,
                'metaRobots' => $metaRobots,
                'variables' => [
                    'item' => $item ?? null,
                    'userId' => $author->id ?? null,
                    'itemsizes' => $itemsizes
                    ]
                ];
    }

    public function add() {
        $author = $this->authentication->getUser();

        $item = $_POST['item'];
        
        //upload file if it has been selected
        if ($_FILES['file']['size'] > 0){
            $return = $this->itemsTable->upload($item['itemPicture']);
            $item['itemFileName'] = $return['fileNameNew'];
            //end upload files and handle any errors
                if ($return['message'] == '') {
                    $itemEntity = $author->addItem($item);

                    foreach ($_POST['itemsize'] as $sizeId) {
                        $itemEntity->addSize($sizeId);
                    }
                    unset($_SESSION['item']);
                    unset($_SESSION['itemsize']);
                    header('location: /item/list');
                } else {
                    $_SESSION['item'] = $item;
                    //PIG $_SESSION['itemsize'] = $itemsize;
                    $_SESSION['itemErrorMessage'] = $return['message'];
                    /*PIG
                    echo '<pre>'; print_r($_SESSION); echo '</pre>'; 
                    echo '<pre>'; print_r($_POST); echo '</pre>'; 
                    die;*/
                    header('location: /item/addpage');
                }
        // if no file is selected submit the rest of the form
        } else {
            $itemEntity = $author->addItem($item);

            foreach ($_POST['itemsize'] as $sizeId) {
                $itemEntity->addSize($sizeId);
            }
            header('location: /item/list');

        }
        
    }

    public function addpage() {
        $itemsizes = $this->itemSizesTable->findAll();


        $title = 'Add a new item';
        $metaRobots = 'noindex';

        return ['template' => 'additem.html.php', 
                'title' => $title,
                'metaRobots' => $metaRobots,
                'variables' => [
                    'itemsizes' => $itemsizes
                ]
    ];

    }

    //hacked c&p code

    public function buy() {

        
        //echo '<pre>'; print_r($_SESSION); echo '</pre>';   
        if (isset($_POST['add'])){
            if (isset($_SESSION["cart"])){
                $item_array_id = array_column($_SESSION["cart"],"item_id");
                if (!in_array($_GET["id"],$item_array_id)){
                    $count = count($_SESSION["cart"]);
                    $item_array = array(
                        'item_id' => $_GET["id"],
                        'item_name' => $_POST["hidden_name"],
                        'item_description' => $_POST["hidden_description"],
                        'item_price' => $_POST["hidden_price"],
                        'item_quantity' => $_POST["quantity"],
                        'item_size' => $_POST["size"]
                    );
                    $_SESSION["cart"][$count] = $item_array;
                }else{
                    echo '<script>alert("Item is already Added to Cart")</script>';

                    echo '<script>window.location="/item/list"</script>';
                    

                }
            }else{
            
            $item_array = array(
                'item_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'item_description' => $_POST["hidden_description"],
                'item_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
                'item_size' => $_POST["size"]
            );
            $_SESSION['cart'][0] = $item_array;
            }
        }

        header('location: /item/list');

    }

    public function remove () {
                foreach ($_SESSION["cart"] as $keys => $value){
                    if ($value["item_id"] == $_GET["id"]){
                        unset($_SESSION["cart"][$keys]);
                        echo '<script>alert("Item has been Removed...!")</script>';
                        echo '<script>window.location="/item/list"</script>';
                    }
                }
                header('location: /item/list');
            }
        
            
    //end

    public function success() {

        unset($_SESSION["cart"]);
		return ['template' => 'itemsuccess.html.php', 'title' => 'Payment Successful'];
	}

    public function failure() {

        
		return ['template' => 'itemfailure.html.php', 'title' => 'Payment Error'];
	}


}
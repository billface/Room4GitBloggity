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
                    'itemFileName' => $item['itemFileName'],
                    'name' => $author['name'],
                    'email' => $author['email'],
                    'authorId' => $author['id']

                ];
      
          }

        $title = 'Items List';
        
        //hacked c&p code
        if(!empty($_SESSION["cart"])){
            $total = 0;
            foreach ($_SESSION["cart"] as $key => $value) {
               
                $total = $total + ($value["item_quantity"] * $value["product_price"]);
            }
        }
        else $total=0;

        //end

        $author = $this->authentication->getUser();


        return ['template' => 'items.html.php', 
				'title' => $title, 
				'variables' => [
						'items' => $items,
                        'userId' => $author['id'] ?? null,
                        'total' => $total


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
        //upload files
            $file = $_FILES['file'];
            //print_r($file);
            //die;
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileSize = $_FILES['file']['size'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png', 'pdf');

            if (in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if ($fileSize < 500000) {
                        $fileNameNew = $item['itemPicture'].'.'.$fileActualExt;
                        $fileDestination = 'uploads/'.$fileNameNew;
                        move_uploaded_file($fileTmpName,$fileDestination);
                        $item['itemFileName'] = $fileNameNew;
                    } else {
                        echo 'Your file was too big! Reduce size to less than 500kb';
                    }

                } else {
                    echo 'There was an error uploading your file';
                }
            } else {
                echo 'This is not an allowed filetype! Convert to jpg or png';
            }
        //end upload files

        $this->itemsTable->save($item);

        header('location: /item/list');
    }

    public function addpage() {

        $title = 'Add a new item';

        return ['template' => 'additem.html.php', 'title' => $title];

    }

    //hacked c&p code

    public function buy() {

        
        //echo '<pre>'; print_r($_SESSION); echo '</pre>';   
        if (isset($_POST['add'])){
            if (isset($_SESSION["cart"])){
                $item_array_id = array_column($_SESSION["cart"],"product_id");
                if (!in_array($_GET["id"],$item_array_id)){
                    $count = count($_SESSION["cart"]);
                    $item_array = array(
                        'product_id' => $_GET["id"],
                        'item_name' => $_POST["hidden_name"],
                        'product_price' => $_POST["hidden_price"],
                        'item_quantity' => $_POST["quantity"],
                    );
                    $_SESSION["cart"][$count] = $item_array;
                }else{
                    echo '<script>alert("Product is already Added to Cart")</script>';

                    echo '<script>window.location="/item/list"</script>';
                    

                }
            }else{
            
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'item_quantity' => $_POST["quantity"],
            );
            $_SESSION['cart'][0] = $item_array;
            }
        }

        header('location: /item/list');

    }

    public function remove () {
                foreach ($_SESSION["cart"] as $keys => $value){
                    if ($value["product_id"] == $_GET["id"]){
                        unset($_SESSION["cart"][$keys]);
                        echo '<script>alert("Product has been Removed...!")</script>';
                        echo '<script>window.location="/item/list"</script>';
                    }
                }
                header('location: /item/list');
            }
        
            
    //end


}
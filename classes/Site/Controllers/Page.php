<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Page {
	private $authorsTable;
    private $pagesTable;
    private $blogsTable;
    private $eventsTable;



	public function __construct(DatabaseTable $pagesTable, DatabaseTable $authorsTable, Authentication $authentication, DatabaseTable $blogsTable, DatabaseTable $eventsTable) {
        $this->authorsTable = $authorsTable;
        $this->pagesTable = $pagesTable;
		$this->authentication = $authentication;
        $this->blogsTable = $blogsTable;
        $this->eventsTable = $eventsTable;


	}

	public function list() {
        $result = $this->pagesTable->findAll();

        $pages = [];
          foreach ($result as $page) {
            $author = $this->authorsTable->findById($page['authorId']);
      
            $pages[] = [
                    'id' => $page['id'],
                    'pageHeading' => $page['pageHeading'],
					'pageText' => $page['pageText'],
                    'name' => $author['name'],
                    'email' => $author['email'],
                    'authorId' => $author['id']
                ];
      
          }
      
        $title = 'Page list';

		$author = $this->authentication->getUser();

		return ['template' => 'pages.html.php', 
				'title' => $title, 
				'variables' => [
						'pages' => $pages,
                        'userId' => $author['id'] ?? null
                    ]
				];
        
    }

	public function saveEdit() {
        $author = $this->authentication->getUser();

        
        $authorObject = new \Site\Entity\Author($this->pagesTable, $this->blogsTable, $this->eventsTable);

        $authorObject->id = $author['id'];
        $authorObject->name = $author['name'];
        $authorObject->email = $author['email'];
        $authorObject->password = $author['password'];
            
        $page = $_POST['page'];
        //the above is from form, below is others

        $authorObject->addPage($page);
        /*
        if (isset($_GET['id'])) {
            $page = $this->pagesTable->findById($_GET['id']);

            if ($page['authorId'] != $author['id']) {
                return;
            }
        }
            
        $page = $_POST['page'];
        //the above is from form, below is others
        $page['authorId'] = $author['id'];

        $this->pagesTable->save($page);

        */

        header('location: /page/list');

    }

    public function displayEdit() {

        $author = $this->authentication->getUser();

        $page = $this->pagesTable->findById($_GET['id']);

        $title = 'Edit page';

        return ['template' => 'editpage.html.php', 
                'title' => $title,
                'variables' => [
                    'page' => $page,
                    'userId' => $author['id'] ?? null
                    ]
                ];
    }
    

	public function home() {

        $page = $this->pagesTable->findById(1);

        $title = 'The Home page';
        $metaDescription = $page['metaDescription'];
        return ['template' => 'basic.html.php',
                 'title' => $title,
                 'metaDescription' => $metaDescription,
                 'variables' => [
                    'page' => $page
                    ]
                ];
    }

    public function about() {

        $page = $this->pagesTable->findById(2);

        $title = 'About a rapper';
        $metaDescription = $page['metaDescription'];

        return ['template' => 'basic.html.php',
                 'title' => $title,
                 'metaDescription' => $metaDescription,
                 'variables' => [
                    'page' => $page
                    ]
                ];
    }
}
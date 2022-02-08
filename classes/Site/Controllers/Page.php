<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Page {
	private $pagesTable;
	private $authorsTable;
    private $blogsTable;
    private $eventsTable;
    private $commentsTable;




	public function __construct(DatabaseTable $pagesTable, DatabaseTable $authorsTable, Authentication $authentication, DatabaseTable $blogsTable, DatabaseTable $eventsTable, DatabaseTable $commentsTable) {
		$this->pagesTable = $pagesTable;
		$this->authorsTable = $authorsTable;
		$this->authentication = $authentication;
        $this->blogsTable = $blogsTable;
        $this->eventsTable = $eventsTable;
        $this->commentsTable = $commentsTable;

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

        $authorObject = new \Site\Entity\Author($this->blogsTable, $this->pagesTable, $this->eventsTable, $this->commentsTable);

        $authorObject->id = $author['id'];
        $authorObject->name = $author['name'];
        $authorObject->email = $author['email'];
        $authorObject->password = $author['password'];
            
        $page = $_POST['page'];
        //the above is from form, below is others

        $authorObject->addPage($page);

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

        $title = 'The Home site';
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
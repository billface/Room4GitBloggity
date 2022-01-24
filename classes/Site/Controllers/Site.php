<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Site {
	private $siteTable;
	private $authorsTable;


	public function __construct(DatabaseTable $siteTable, DatabaseTable $authorsTable, Authentication $authentication) {
		$this->siteTable = $siteTable;
		$this->authorsTable = $authorsTable;
		$this->authentication = $authentication;

	}

	public function list() {
        $result = $this->siteTable->findAll();

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

        //added security from Ninja pg 493 PDF 363
        if (isset($_GET['id'])) {
            $page = $this->siteTable->findById($_GET['id']);

            if ($page['authorId'] != $author['id']) {
                return;
            }
        }
            
        $page = $_POST['page'];
        //the above is from form, below is others
        $page['authorId'] = $author['id'];

        $this->siteTable->save($page);

        header('location: /site/list');

    }

    public function displayEdit() {

        $author = $this->authentication->getUser();

        $page = $this->siteTable->findById($_GET['id']);

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

        $page = $this->siteTable->findById(1);

        $title = 'The Home page';

        return ['template' => 'basic.html.php',
                 'title' => $title,
                 'variables' => [
                    'page' => $page
                    ]
                ];
    }

    public function about() {

        $page = $this->siteTable->findById(2);

        $title = 'About a rapper';

        return ['template' => 'basic.html.php',
                 'title' => $title,
                 'variables' => [
                    'page' => $page
                    ]
                ];
    }
}
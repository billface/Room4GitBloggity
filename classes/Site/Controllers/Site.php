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

        $sites = [];
          foreach ($result as $site) {
            $author = $this->authorsTable->findById($site['authorId']);
      
            $sites[] = [
                    'id' => $site['id'],
                    'siteHeading' => $site['siteHeading'],
					'siteText' => $site['siteText'],
                    'name' => $author['name'],
                    'email' => $author['email'],
                    'authorId' => $author['id']
                ];
      
          }
      
        $title = 'Page list';

		$author = $this->authentication->getUser();

		return ['template' => 'sites.html.php', 
				'title' => $title, 
				'variables' => [
						'sites' => $sites,
                        'userId' => $author['id'] ?? null
                    ]
				];
        
    }

	public function saveEdit() {
        $author = $this->authentication->getUser();

        //added security from Ninja pg 493 PDF 363
        if (isset($_GET['id'])) {
            $site = $this->siteTable->findById($_GET['id']);

            if ($site['authorId'] != $author['id']) {
                return;
            }
        }
            
        $site = $_POST['site'];
        //the above is from form, below is others
        $site['authorId'] = $author['id'];

        $this->siteTable->save($site);

        header('location: /site/list');

    }

    public function displayEdit() {

        $author = $this->authentication->getUser();

        $site = $this->siteTable->findById($_GET['id']);

        $title = 'Edit page';

        return ['template' => 'editsite.html.php', 
                'title' => $title,
                'variables' => [
                    'site' => $site,
                    'userId' => $author['id'] ?? null
                    ]
                ];
    }
    

	public function home() {

        $site = $this->siteTable->findById(1);

        $title = 'The Home site';
        $site['metaDescription'] = 'this isnt it';
        return ['template' => 'basic.html.php',
                 'title' => $title,
                 'variables' => [
                    'site' => $site
                    ]
                ];
    }

    public function about() {

        $site = $this->siteTable->findById(2);

        $title = 'About a rapper';

        return ['template' => 'basic.html.php',
                 'title' => $title,
                 'variables' => [
                    'site' => $site
                    ]
                ];
    }
}
<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Site {
	private $siteTable;
	private $authorsTable;
    private $blogsTable;



	public function __construct(DatabaseTable $siteTable, DatabaseTable $authorsTable, Authentication $authentication, DatabaseTable $blogsTable) {
		$this->siteTable = $siteTable;
		$this->authorsTable = $authorsTable;
		$this->authentication = $authentication;
        $this->blogsTable = $blogsTable;

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

        $authorObject = new \Site\Entity\Author($this->blogsTable, $this->siteTable);

        $authorObject->id = $author['id'];
        $authorObject->name = $author['name'];
        $authorObject->email = $author['email'];
        $authorObject->password = $author['password'];
            
        $site = $_POST['site'];
        //the above is from form, below is others

        $authorObject->addSite($site);

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
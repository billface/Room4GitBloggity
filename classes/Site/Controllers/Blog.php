<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Blog {
    private $authorsTable;
    private $blogsTable;
    private $commentsTable;
    private $displayCommentsTable;

    public function __construct(DatabaseTable $blogsTable, DatabaseTable $authorsTable, Authentication $authentication,  DatabaseTable $commentsTable, DatabaseTable $displayCommentsTable) {
		$this->blogsTable = $blogsTable;
        $this->authorsTable = $authorsTable;
        $this->authentication = $authentication;
        $this->commentsTable = $commentsTable;
        $this->displayCommentsTable = $displayCommentsTable;    
    }

    public function list() {
        $result = $this->blogsTable->findAll();

        $blogs = [];
          foreach ($result as $blog) {
            $author = $this->authorsTable->findById($blog['authorId']);
      
            $blogs[] = [
                    'id' => $blog['id'],
                    'blogHeading' => $blog['blogHeading'],
                    'blogDate' => $blog['blogDate'],
                    'name' => $author['name'],
                    'email' => $author['email'],
                    'authorId' => $author['id']
                ];
      
          }
      
        $title = 'Blog list';

        $totalBlogs = $this->blogsTable->total();

        $author = $this->authentication->getUser();

        return ['template' => 'blogs.html.php', 
				'title' => $title, 
				'variables' => [
						'totalBlogs' => $totalBlogs,
						'blogs' => $blogs,
                        'userId' => $author['id'] ?? null
                    ]
				];
        
    }

    public function home() {
        $title = 'Internet Blogging Database';

        return ['template' => 'home.html.php', 'title' => $title];
    }

    

    public function delete() {
        $this->blogsTable->delete($_POST['blogId']);
    
        header('location: /blog/list');
    }


    public function deletecomment() {
        $this->commentsTable->delete($_POST['commId']);
    
        header('location: /blog/wholeblog?id=' . $_POST['headerBlogId']);
    }



    public function saveEdit() {
            $author = $this->authentication->getUser();

            $blog = $_POST['blog'];
            //the above is from form, below is others
            $blog['blogModDate'] = new \DateTime();
            $blog['authorId'] = $author['id'];

            $this->blogsTable->save($blog);

            header('location: /blog/wholeblog?id=' . $blog['id']);
            //header('location: /blog/list');

    }

    public function displayEdit() {

            $blog = $this->blogsTable->findById($_GET['id']);

            $title = 'Edit blog';

            return ['template' => 'editblog.html.php', 
                    'title' => $title,
                    'variables' => [
						'blog' => $blog
					    ]
                    ];
    }

    public function editcomment() {
        if (isset($_POST['comment'])) {

            $author = $this->authentication->getUser();


			$comment = $_POST['comment'];
			$comment['authorId'] = $author['id'];
			$comment['commModDate'] = new \DateTime();

			$this->commentsTable->save($comment);

        	header('location: /blog/wholeblog?id=' . $comment['commBlogId']);  

		}
		
    }

    public function add() {
            $author = $this->authentication->getUser();

            $blog = $_POST['blog'];
            //the above is from form, below is others
            $blog['blogDate'] = new \Datetime();
            $blog['authorId'] = $author['id'];

            $this->blogsTable->save($blog);

            header('location: /blog/list');
    }

    public function addpage() {

            $title = 'Add a new blog';

            return ['template' => 'addblog.html.php', 'title' => $title];
        
    }

    public function wholeblog() {
        $result = $this->blogsTable->findAllById($_GET['id']);

		$blogs = [];
			foreach ($result as $blog) {
				$author = $this->authorsTable->findById($blog['authorId']);

			$blogs[] = [
					'id' => $blog['id'],
					'blogHeading' => $blog['blogHeading'],
					'blogText' => $blog['blogText'],
					'blogDate' => $blog['blogDate'],
					'blogModDate' => $blog['blogModDate'],
					'name' => $author['name'],
					'email' => $author['email'],
                    'authorId' => $author['id']

				];

			}
		
		$resultComm = $this->displayCommentsTable->findAllById($_GET['id']);

		$comments = [];
			foreach ($resultComm as $comment) {
				$author = $this->authorsTable->findById($comment['authorId']);

			$comments[] = [
					'id' => $comment['id'],
					'commText' => $comment['commText'],
					'commDate' => $comment['commDate'],
					'commBlogId' => $comment['commBlogId'],
					'commModDate' => $comment['commModDate'],
					'name' => $author['name'],
					'email' => $author['email'],
                    'authorId' => $author['id']

				];

            }

        
        

        if (isset($_GET['commentid'])) {
            
            $comment2edit = $this->commentsTable->findById($_GET['commentid']);

            
        }

        $title = 'Whole Blogger';

        $author = $this->authentication->getUser();


        return ['template' => 'wholeblog.html.php',
                'title' => $title,
                'variables' => [
                    'blogs' => $blogs,
                    'comments' => $comments,
                    'comment2edit' => $comment2edit,
                    'userId' => $author['id'] ?? null
                    ]
                ];

		
    }

    public function addcomment() {

            $author = $this->authentication->getUser();

            $comment = $_POST['comment'];
            $comment['authorId'] = $author['id'];
            $comment['commDate'] = new \Datetime();
    

            $this->commentsTable->save($comment);
        
            //head back to the current page after inserting comment
            header('location: /blog/wholeblog?id=' . $comment['commBlogId']);
            die;

    } 
}
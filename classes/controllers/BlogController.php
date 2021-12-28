<?php

class BlogController {
    private $authorsTable;
    private $blogsTable;
    private $commentsTable;
    private $displayCommentsTable;
    private $pageTable;


    public function __construct(DatabaseTable $authorsTable, DatabaseTable $blogsTable, DatabaseTable $commentsTable, DatabaseTable $displayCommentsTable, DatabaseTable $pageTable) {
		$this->authorsTable = $authorsTable;
        $this->blogsTable = $blogsTable;
        $this->commentsTable = $commentsTable;
        $this->displayCommentsTable = $displayCommentsTable;
        $this->pageTable = $pageTable;

	}

    public function list() {

        $page = $this->pageTable->findById(5);

        $result = $this->blogsTable->findAll();

        $blogs = [];
          foreach ($result as $blog) {
            $author = $this->authorsTable->findById($blog['authorId']);
      
          $blogs[] = [
                  'id' => $blog['id'],
                  'blogHeading' => $blog['blogHeading'],
                  'blogDate' => $blog['blogDate'],
                  'name' => $author['name'],
                  'email' => $author['email']
              ];
      
          }
      
        $title = 'Blog list';
      
        $totalBlogs = $this->blogsTable->total();

        return ['template' => 'blogs.html.php', 
				'title' => $title, 
				'variables' => [
						'totalBlogs' => $totalBlogs,
						'blogs' => $blogs,
                        'page' => $page
					]
				];
        
    }

    public function home() {

        $page = $this->pageTable->findById(1);

        $title = 'Internet Blog Database';

        return ['template' => 'basic.html.php',
                 'title' => $title,
                 'variables' => [
                    'page' => $page
                    ]
                ];
    }

    public function about() {

        $page = $this->pageTable->findById(2);


        $title = 'About a rapper';

        return ['template' => 'basic.html.php',
                 'title' => $title,
                 'variables' => [
                    'page' => $page
                    ]
                ];
    }

    public function events() {

        $page = $this->pageTable->findById(3);


        $title = 'Coming soon';

        return ['template' => 'basic.html.php',
                 'title' => $title,
                 'variables' => [
                    'page' => $page
                    ]
                ];
    }

    public function shop() {

        $page = $this->pageTable->findById(4);


        $title = 'Roll up, roll up';

        return ['template' => 'basic.html.php',
                 'title' => $title,
                 'variables' => [
                    'page' => $page
                    ]
                ];
    }

    

    public function delete() {
        $this->blogsTable->delete($_POST['blogId']);
    
        header('location: index.php?action=list');
    }


    public function deleteComment() {
        $this->commentsTable->delete($_POST['commId']);
    
        header('location: index.php?action=wholeBlog&id=' . $_POST['headerBlogId']);
    }



    public function edit() {
        if (isset($_POST['blog'])) {
            
            $blog = $_POST['blog'];
            //the above is from form, below is others
            $blog['blogModDate'] = new DateTime();
            $blog['authorId'] = 2;

            $this->blogsTable->save($blog);

            header('location: index.php?action=wholeBlog&id=' . $blog['id']);

        }

        else {
            $blog = $this->blogsTable->findById($_GET['id']);

            $title = 'Edit bloggity';

            return ['template' => 'editblog.html.php', 
                    'title' => $title,
                    'variables' => [
						'blog' => $blog
					    ]
                    ];



        }
    }

    public function editComment() {
        if (isset($_POST['comment'])) {

			$comment = $_POST['comment'];
			$comment['authorId'] = 2;
			$comment['commModDate'] = new DateTime();

			$this->commentsTable->save($comment);

        	header('location: index.php?action=wholeBlog&id=' . $comment['commBlogId']);  

		}
		else {

			$comment = $this->commentsTable->findById($_GET['id']);

		}
    }

    public function add() {
        if (isset($_POST['blog'])) {

            $blog = $_POST['blog'];
            //the above is from form, below is others
            $blog['blogDate'] = new Datetime();
            $blog['authorId'] = 2;

            $this->blogsTable->save($blog);

            header('location: index.php?action=list');
        }
        else {
            $title = 'Add a new blog';

            return ['template' => 'addblog.html.php', 'title' => $title];
        }
    }

    public function wholeBlog() {
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
					'email' => $author['email']
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
					'email' => $author['email']
				];

            }

        if (isset($_POST['comment'])) {
        

        // 1 currently represents the author id & blog id
        
            $comment = $_POST['comment'];
            $comment['authorId'] = 2;
            $comment['commDate'] = new Datetime();
    

            $this->commentsTable->save($comment);
        
            //head back to the current page after inserting comment
            header('location: index.php?action=wholeBlog&id=' . $blog['id']);
            die;

        } 
        
        else {

            if (isset($_GET['commentId'])) {
            
            $comment2edit = $this->commentsTable->findById($_GET['commentId']);

            }
        }

        $title = 'Whole Blog';

        return ['template' => 'wholeblog.html.php',
                'title' => $title,
                'variables' => [
                    'blogs' => $blogs,
                    'comments' => $comments,
                    'comment2edit' => $comment2edit
                    ]
                ];

		
    }
}
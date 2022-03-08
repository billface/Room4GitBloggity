<?php
namespace Site\Controllers;
use \Ninja\DatabaseTable;
use \Ninja\Authentication;


class Blog {
    private $blogsTable;
    private $authorsTable;
    private $commentsTable;
    private $displayCommentsTable;
    private $pagesTable;
    private $eventsTable;
    private $categoriesTable;
	private $authentication;



    public function __construct(DatabaseTable $blogsTable, DatabaseTable $authorsTable,  DatabaseTable $commentsTable, DatabaseTable $displayCommentsTable, DatabaseTable $pagesTable, DatabaseTable $eventsTable, DatabaseTable $categoriesTable, Authentication $authentication) {
		$this->blogsTable = $blogsTable;
        $this->authorsTable = $authorsTable;
        $this->commentsTable = $commentsTable;
        $this->displayCommentsTable = $displayCommentsTable; 
        $this->pagesTable = $pagesTable;
        $this->eventsTable = $eventsTable;
        $this->categoriesTable = $categoriesTable;
		$this->authentication = $authentication;


    }

    public function list() {

        $index = $_GET['index'] ?? 1;

		$offset = ($index-1)*10;

        if (isset($_GET['category']))
		{
			$category = $this->categoriesTable->findById($_GET['category']);
			$blogs = $category->getBlogs(10, $offset);
            $totalBlogs = $category->getNumBlogs();

		}
        else
        {
            $blogs = $this->blogsTable->findAll('blogdate DESC', 10, $offset);
            $totalBlogs = $this->blogsTable->total();

        }

        $title = 'Blog list';


        $author = $this->authentication->getUser();

        return ['template' => 'blogs.html.php', 
				'title' => $title, 
				'variables' => [
						'totalBlogs' => $totalBlogs,
						'blogs' => $blogs,
                        'user' => $author, //previously 'userId' => $author->id ?? null,
                        'categories' => $this->categoriesTable->findAll(),
                        'currentIndex' => $index,
                        'categoryId' => $_GET['category'] ?? null
                    ]
				];
        
    }

    

    public function delete() {

        $author = $this->authentication->getUser();

        $blog = $this->blogsTable->findById($_POST['blogId']);

        if ($blog->authorId != $author->id && !$author->hasPermission(\Site\Entity\Author::DELETE_BLOGS) ) {
			return;
		}
		
        $this->blogsTable->delete($_POST['blogId']);
    
        header('location: /blog/list');
    }


    public function deletecomment() {

        $author = $this->authentication->getUser();

        $comment = $this->commentsTable->findById($_POST['commId']);

        if ($comment->authorId != $author->id) {
			return;
		}
        $this->commentsTable->delete($_POST['commId']);
    
        header('location: /blog/wholeblog?id=' . $_POST['headerBlogId']);
    }

    public function add() {
        $author = $this->authentication->getUser();

        $blog = $_POST['blog'];
        //the above is from form, below is others
        $blog['blogDate'] = new \Datetime();

        $blogEntity = $author->addBlog($blog); 

        foreach ($_POST['category'] as $categoryId) {
            $blogEntity->addCategory($categoryId);
        }

        header('location: /blog/list');
}

public function addpage() {
        $categories = $this->categoriesTable->findAll();


        $title = 'Add a new blog';

        return ['template' => 'addblog.html.php',
                'title' => $title,
                'variables' => [
                    'categories' => $categories
                ]
            ];
    
}



    public function saveEdit() {
            $author = $this->authentication->getUser();

            $blog = $_POST['blog'];
            //the above is from form, below is others
            $blog['blogModDate'] = new \DateTime();

            $blogEntity = $author->addBlog($blog);

            $blogEntity->clearCategories();

            foreach ($_POST['category'] as $categoryId) {
                $blogEntity->addCategory($categoryId);
            }
            header('location: /blog/wholeblog?id=' . $blog['id']);
            //header('location: /blog/list');

    }

    public function displayEdit() {
        
        $author = $this->authentication->getUser();
        $categories = $this->categoriesTable->findAll();

        $blog = $this->blogsTable->findById($_GET['id']);

        $title = 'Edit blog';

        return ['template' => 'editblog.html.php', 
                'title' => $title,
                'variables' => [
                    'blog' => $blog,
                    'user' => $author, //previously 'userId' => $author->id ?? null,
                    'categories' => $categories
                    ]
                ];
    }

    public function editcomment() {
        if (isset($_POST['comment'])) {

            $author = $this->authentication->getUser();

            $comment = $_POST['comment'];
			$comment['commModDate'] = new \DateTime();
    

            $author->addComment($comment);

        	header('location: /blog/wholeblog?id=' . $comment['commBlogId']);  

		}
		
    }

    

    public function wholeblog() {
        $blog = $this->blogsTable->findById($_GET['id']);

		$comments = $this->displayCommentsTable->findAllById($_GET['id']);

		

        
        

        if (isset($_GET['commentid'])) {
            
            $comment2edit = $this->commentsTable->findById($_GET['commentid']);

            
        }

        $title = 'Whole Blogger';
        $metaDescription = $blog->metaDescription;


        $author = $this->authentication->getUser();

        return ['template' => 'wholeblog.html.php',
                'title' => $title,
                'metaDescription' => $metaDescription,
                'variables' => [
                    'blog' => $blog,
                    'comments' => $comments,
                    'comment2edit' => $comment2edit,
                    'user' => $author
                    ]
                ];

		
    }

    public function addcomment() {

            $author = $this->authentication->getUser();


            $comment = $_POST['comment'];
            $comment['commDate'] = new \Datetime();
    

            $author->addComment($comment);
        
            //head back to the current page after inserting comment
            header('location: /blog/wholeblog?id=' . $comment['commBlogId']);
            die;

    } 
}
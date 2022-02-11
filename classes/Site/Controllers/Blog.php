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
    private $blogCategoriesTable;
    private $authentication;




    public function __construct(DatabaseTable $blogsTable, DatabaseTable $authorsTable, DatabaseTable $blogCategoriesTable, Authentication $authentication,  DatabaseTable $commentsTable, DatabaseTable $displayCommentsTable, DatabaseTable $pagesTable, DatabaseTable $eventsTable) {
		$this->blogsTable = $blogsTable;
        $this->authorsTable = $authorsTable;
        $this->blogCategoriesTable = $blogCategoriesTable;
        $this->commentsTable = $commentsTable;
        $this->displayCommentsTable = $displayCommentsTable; 
        $this->pagesTable = $pagesTable;
        $this->eventsTable = $eventsTable;
        $this->authentication = $authentication;


    }

    public function list() {
        $blogs = $this->blogsTable->findAll();
      
        $title = 'Blog list';

        $totalBlogs = $this->blogsTable->total();

        $author = $this->authentication->getUser();

        return ['template' => 'blogs.html.php', 
				'title' => $title, 
				'variables' => [
						'totalBlogs' => $totalBlogs,
						'blogs' => $blogs,
                        'userId' => $author->id ?? null
                    ]
				];
        
    }

    

    public function delete() {

        $author = $this->authentication->getUser();

        $blog = $this->blogsTable->findById($_POST['blogId']);

        if ($blog->authorId != $author->id) {
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

        foreach ($_POST['blogCategory'] as $blogCategoryId) {
            $blogEntity->addBlogCategory($blogCategoryId);
        }

        header('location: /blog/list');
}

public function addpage() {
        $blogCategories = $this->blogCategoriesTable->findAll();

        $title = 'Add a new blog';

        return ['template' => 'addblog.html.php', 
                'title' => $title,
                'variables' => [
                    'blogCategories' => $blogCategories
                ]
                ];
    
}



    public function saveEdit() {
            $author = $this->authentication->getUser();

            $blog = $_POST['blog'];
            //the above is from form, below is others
            $blog['blogModDate'] = new \DateTime();

            $blogEntity = $author->addBlog($blog);

            foreach ($_POST['blogCategory'] as $blogCategoryId) {
                $blogEntity->addBlogCategory($blogCategoryId);
            }

            header('location: /blog/wholeblog?id=' . $blog['id']);
            //header('location: /blog/list');

    }

    public function displayEdit() {
        
        $author = $this->authentication->getUser();
        $blogCategories = $this->blogCategoriesTable->findAll();


        $blog = $this->blogsTable->findById($_GET['id']);

        $title = 'Edit blog';

        return ['template' => 'editblog.html.php', 
                'title' => $title,
                'variables' => [
                    'blog' => $blog,
                    'userId' => $author->id ?? null,
                    'blogCategories' => $blogCategories

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
                    'userId' => $author->id ?? null
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
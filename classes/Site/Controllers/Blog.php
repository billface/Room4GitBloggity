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
    private $itemsTable;
    private $blogCatsTable;
    private $authentication;



	//the order of constucts is important. most specifically the position of $authentication vs SiteRoutes getRoutes()
    public function __construct(DatabaseTable $blogsTable, DatabaseTable $authorsTable,  DatabaseTable $commentsTable, DatabaseTable $displayCommentsTable, DatabaseTable $pagesTable, DatabaseTable $eventsTable, DatabaseTable $itemsTable, DatabaseTable $blogCatsTable, Authentication $authentication) {
		$this->blogsTable = $blogsTable;
        $this->authorsTable = $authorsTable;
        $this->commentsTable = $commentsTable;
        $this->displayCommentsTable = $displayCommentsTable; 
        $this->pagesTable = $pagesTable;
        $this->eventsTable = $eventsTable;
        $this->itemsTable = $itemsTable;
        $this->blogCatsTable = $blogCatsTable;
        $this->authentication = $authentication;
        

    }

    public function list() {

        $index = $_GET['index'] ?? 1;

        $offset = ($index-1)*10;

        if (isset($_GET['category']))
        //lists number of blogs in each category
		{
			$category = $this->blogCatsTable->findById($_GET['category']);
			$blogs = $category->getBlogs(10, $offset);
            $totalBlogs = $category->getNumBlogs();

		}
        else
        {
            $blogs = $this->blogsTable->findAll('blogdate DESC', 10, $offset);
            $totalBlogs = $this->blogsTable->total();
        }
      
        $title = 'Blog list';
        $metaDescription = 'Blog List';


        $author = $this->authentication->getUser();

        return ['template' => 'blogs.html.php', 
				'title' => $title, 
                'metaRobots' => 'noindex',
                'metaDescription' => $metaDescription,
				'variables' => [
						'totalBlogs' => $totalBlogs,
						'blogs' => $blogs,
                        'user' => $author, //previously 'userId' => $author->id ?? null,
                        'categories' => $this->blogCatsTable->findAll(),
                        'currentIndex' => $index,
                        'categoryId' => $_GET['category'] ?? null


                    ]
				];
        
    }

    

    public function delete() {

        $author = $this->authentication->getUser();

        $blog = $this->blogsTable->findById($_POST['blogId']);

        if ($blog->authorId != $author->id && !$author->hasPermission(\Site\Entity\Author::SUPERUSER) ) {
			return;
		}
		
        $this->blogsTable->delete($_POST['blogId']);
    
        header('location: /blog/list');
    }

    public function saveEdit() {
            $author = $this->authentication->getUser();

            $blog = $_POST['blog'];
            //the above is from form, below is others
            if (isset($_GET['id'])) {
                $blog['blogModDate'] = new \DateTime();
                $blogEntity = $author->addBlog($blog); 

                //a little fudge to edit categories
                $blogEntity->clearCategories();

                if(isset($_POST['category'])){
                    foreach ($_POST['category'] as $categoryId) {
                        $blogEntity->addCategory($categoryId);
                    }
                }   

                header('location: /blog/wholeblog?id=' . $blog['id']);
            
            } else {
                
                $blog['blogDate'] = new \Datetime();
                $blogEntity = $author->addBlog($blog);

                if(isset($_POST['category'])){
                    foreach ($_POST['category'] as $categoryId) {
                        $blogEntity->addCategory($categoryId);
                    }
                } 

                header('location: /blog/list');
            }

            //PIG might be able to return Entitiy with blog Id on newly created blogs??

    }

    public function addOrEdit() {
        
        $author = $this->authentication->getUser();
        $categories = $this->blogCatsTable->findAll();

        if (isset($_GET['id'])) {
            $blog = $this->blogsTable->findById($_GET['id']);
        }

        $title = 'Edit blog';
        $metaRobots = 'noindex';
        $tinyMCE = true;

        return ['template' => 'blogedit.html.php', 
                'title' => $title,
                'tinyMCE' => $tinyMCE,
                'metaRobots' => $metaRobots,
                'variables' => [
                    'blog' => $blog ?? null,
                    'user' => $author, //previously 'userId' => $author->id ?? null,
                    'categories' => $categories
                    ]
                ];
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

        return ['template' => 'blogwhole.html.php',
                'title' => $title,
                'metaDescription' => $metaDescription,
                'variables' => [
                    'blog' => $blog,
                    'comments' => $comments,
                    'comment2edit' => $comment2edit ?? '',
                    'user' => $author, //previously 'userId' => $author->id ?? null,
                    ]
                ];

		
    }

    public function addOrEditComment() {
        $author = $this->authentication->getUser();

        
        $comment = $_POST['comment'];
        
            if (isset($_POST['comment[commEdit]'])) {
			    $comment['commModDate'] = new \DateTime();
            } else {
                $comment['commDate'] = new \Datetime();
            }

            $author->addComment($comment);

        	header('location: /blog/wholeblog?id=' . $comment['commBlogId']);  

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
    
}
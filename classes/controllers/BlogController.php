<?php

class BlogController {
    private $authorsTable;
    private $blogsTable;
    private $commentsTable;
    private $displayCommentsTable;

    public function __construct(DatabaseTable $authorsTable, DatabaseTable $blogsTable/*, DatabaseTable $commmentsTable, DatabaseTable $displayCommentsTable*/) {
		$this->authorsTable = $authorsTable;
        $this->blogsTable = $blogsTable;
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
                  'email' => $author['email']
              ];
      
          }
      
        $title = 'Blog list';
      
        $totalBlogs = $this->blogsTable->total();
      
        ob_start();
      
        include  __DIR__ . '/../../templates/blogs.html.php';
      
        $output = ob_get_clean();

        return ['output' => $output, 'title' => $title];
    }

    public function home() {
        $title = 'Internet Blog Database';

        ob_start();

        include  __DIR__ . '/../../templates/home.html.php';

        $output = ob_get_clean();

        return ['output' => $output, 'title' => $title];
    }

    public function delete() {
        $this->blogsTable->delete($_POST['blogId']);
    
        header('location: index.php?action=list');
    }

    public function edit() {
        if (isset($_POST['blog'])) {
            
            $blog = $_POST['blog'];
            //the above is from form, below is others
            $blog['blogModDate'] = new DateTime();
            $blog['authorId'] = 2;

            $this->blogsTable->save($blog);

            header('location: index.php?action=list');
            //header('location: wholeblog.php?id=' . $blog['id']);
        }

        else {
            $blog = $this->blogsTable->findById($_GET['id']);

            $title = 'Edit blog';

            ob_start();

            include  __DIR__ . '/../../templates/editblog.html.php';

            $output = ob_get_clean();

            return ['output' => $output, 'title' => $title];

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

            ob_start();

            include  __DIR__ . '/../../templates/addblog.html.php';

            $output = ob_get_clean();

            return ['output' => $output, 'title' => $title];
        }
    }
}
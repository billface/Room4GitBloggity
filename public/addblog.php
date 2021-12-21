<?php
if (isset($_POST['blog'])) {
  try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../classes/DatabaseTable.php';

    $blogsTable = new DatabaseTable($pdo, 'blog', 'id');

        $blog = $_POST['blog'];
        //the above is from form, below is others
        $blog['blogDate'] = new Datetime();
        $blog['authorId'] = 2;

      
        $blogsTable->save($blog);


      header('location: blogs.php');
    
  }
  catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'Database error: ' . $e->getMessage() . ' in ' .
    $e->getFile() . ':' . $e->getLine();
  }

}
else {
  $title = 'Add a new blog';

  ob_start();

  include  __DIR__ . '/../templates/addblog.html.php';

  $output = ob_get_clean();
}
include  __DIR__ . '/../templates/layout.html.php';
<?php
if (isset($_POST['blogtext'])) {
  try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    include __DIR__ . '/../includes/DatabaseFunctions.php';

      // 1 currently represents the author id
      insertBlog($pdo, $_POST['blogtext'], 1);

      header('location: blogs.php');
      
  }
  catch (PDOException $e) {
    $title = 'An error has occurred';

    $output = 'DAtabase error: ' . $e->getMessage() . ' in ' .
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
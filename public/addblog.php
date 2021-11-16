<?php
if (isset($_POST['blogtext'])) {
  try {
    include __DIR__ . '/../includes/DatabaseConnection.php';
    //include __DIR__ . '/../includes/DatabaseFunctions.php';

      

      $sql = 'INSERT INTO `blog` SET
              `blogheading` = :blogheading,
              `blogtext` = :blogtext,
              `blogdate` = CURDATE(),
              `authorId` = :authorId' ;

      $stmt = $pdo->prepare($sql);

      $stmt->bindValue(':blogheading', $_POST['blogheading']);
      $stmt->bindValue(':blogtext', $_POST['blogtext']);
      $stmt->bindValue(':authorId', 1 );

      $stmt->execute();

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
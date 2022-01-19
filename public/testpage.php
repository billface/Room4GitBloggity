<?php

try {
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../includes/DatabaseFunctions.php';
   
  //$result = findAll($pdo, 'comment');
  //$result = findAll($pdo, 'blog');
  //$result = findById($pdo, 'blog', 'id', 1 );
  //$result = findById($pdo, 'comment', 'commblogid', 1 );
  echo 'FIND BY ID';
  $result = findById($pdo, 'blog', 'id', $_GET['id']);
  echo '<pre>'; print_r($result); echo '</pre>';

  echo 'FIND ALL';
  $result = findAll($pdo, 'blog');
  echo '<pre>'; print_r($result); echo '</pre>';

  echo 'FIND ALL BY ID';
  $result = findAllById($pdo, 'blog', 'id', $_GET['id']);
  echo '<pre>'; print_r($result); echo '</pre>';

  echo 'WHOLEBLOG';
  $blog = wholeBlog($pdo, $_GET['id']);
  echo '<pre>'; print_r($blog); echo '</pre>';

  $title = 'findAllById vs wholeBlog';

  ob_start();

  include  __DIR__ . '/../templates/blogs.html.php';

  $output = ob_get_clean();

}
catch (PDOException $e) {
  $title = 'An error has occurred';

  $output = 'Database error: ' . $e->getMessage() . ' in ' .
  $e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';
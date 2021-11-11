<?php

try {
  include __DIR__ . '/../includes/DatabaseConnection.php';

  deleteBlog($pdo, $_POST['id']);
  
  header('location: blogs.php');
  
}
catch (PDOException $e) {
  $title = 'An error has occurred';

  $output = 'Database error: ' . $e->getMessage() . ' in ' .
  $e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';
<?php

try {
  include __DIR__ . '/../includes/DatabaseConnection.php';
  
  $sql = 'DELETE FROM `blog` WHERE id = :id';

  $stmt = $pdo->prepare($sql);
  
  $stmt->bindValue(':id', $_POST['id']);
  $stmt->execute();

  
  
  header('location: blogs.php');
  
}
catch (PDOException $e) {
  $title = 'An error has occurred';

  $output = 'Database error: ' . $e->getMessage() . ' in ' .
  $e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';
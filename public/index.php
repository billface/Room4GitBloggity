<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=room4Two', 'room4TwoUser', 'mypassword');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  $sql = 'SELECT `blogtext` FROM `blog` WHERE id = 1';
  $result = $pdo->query($sql);
  
  foreach ($result as $row) {
    $blogs[] = $row['blogtext'];
  }
}
catch (PDOException $e) {
  $output = 'Unable to connect to the database server: ' . $e;
}

include  __DIR__ . '/../templates/output.html.php';
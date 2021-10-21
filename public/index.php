<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=room4Two', 'room4TwoUser', 'mypassword');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = 'SELECT `blogtext` FROM `blog` WHERE id = :id';

$statement = $pdo->prepare($sql);
$statement->execute( ['id' => 1] );
$text = $statement->fetchColumn();

$output = $text;
}
catch (PDOException $e) {
  $output = 'Unable to connect to the database server: ' . $e;
}

include  __DIR__ . '/../templates/output.html.php';
<?php

try {
  $pdo = new PDO('mysql:host=localhost;dbname=room4Two', 'room4TwoUser', 'mypassword');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
  $sql = 'SELECT `blogtext`, `name`, `email`
          FROM `blog` INNER JOIN `author`
          ON `authorid` = `author`.`id` WHERE `blog`.`id` = 1';

  $blogs = $pdo->query($sql);

  $title = 'blog list';

  ob_start();

  include  __DIR__ . '/../templates/blogday.html.php';

  $output = ob_get_clean();

}
catch (PDOException $e) {
  $title = 'An error has occurred';

  $output = 'Database error: ' . $e->getMessage() . ' in ' .
  $e->getFile() . ':' . $e->getLine();
}

include  __DIR__ . '/../templates/layout.html.php';
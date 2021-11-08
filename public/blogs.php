<?php

try {
  $pdo = new PDO('mysql:host=localhost;dbname=room4Two', 'room4TwoUser', 'mypassword');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT `blog`.`id`, `blogtext`, `name`, `email`
          FROM `blog` INNER JOIN `author`
          ON `authorid` = `author`.`id`';

  $blogs = $pdo->query($sql);

  $title = 'blog list';

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
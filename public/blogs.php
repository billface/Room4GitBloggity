<?php

try {
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../includes/DatabaseFunctions.php';

  $sql = 'SELECT `blog`.`id`, `blogtext`, `name`, `email`
          FROM `blog` INNER JOIN `author`
          ON `authorid` = `author`.`id`';

  $blogs = $pdo->query($sql);

  $title = 'blog list';

  $totalBlogs = totalBlogs($pdo);

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
<?php

try {
  include __DIR__ . '/../includes/DatabaseConnection.php';
  //include __DIR__ . '/../includes/DatabaseFunctions.php';
  
  function allBlogs($pdo) {
      $blogs = $pdo->prepare('SELECT `blog`.`id`, `blogheading`, `name`, `email`
      FROM `blog` INNER JOIN `author`
      ON `authorid` = `author`.`id`');
      $blogs->execute();
      
      return $blogs->fetchAll();
  }

  $blogs = allBlogs($pdo);

  $title = 'Blog list';

  function totalBlogs($pdo) {
    $query = $pdo->prepare('SELECT COUNT(*) FROM `blog`');
    $query->execute();

    $row = $query->fetch();

    return $row[0];
  }

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
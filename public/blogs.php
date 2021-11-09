<?php

try {
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../includes/DatabaseFunctions.php';

  

  $blogs = allBlogs($pdo);

  $title = 'Blog list';

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
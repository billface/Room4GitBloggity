<?php

try {
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../includes/DatabaseFunctions.php';


  $result = findAll($pdo, 'blog');

  $blogs = [];
	foreach ($result as $blog) {
		$author = findById($pdo, 'author', 'id', $blog['authorid']);

    $blogs[] = [
			'id' => $blog['id'],
			'blogheading' => $blog['blogheading'],
			'blogdate' => $blog['blogdate'],
			'name' => $author['name'],
			'email' => $author['email']
		];

	}

  $title = 'Blog list';

  $totalBlogs = total($pdo, 'blog');

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
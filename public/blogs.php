<?php

try {
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../includes/DatabaseFunctions.php';



  $result = findAll($pdo, 'blog');

  $blogs = [];
	foreach ($result as $blog) {
		//$author = findById($pdo, 'author', 'id', $blog['authorId']);
    $author = find($pdo, 'author', 'id', $blog['authorId'])[0];

    $blogs[] = [
			'id' => $blog['id'],
			'blogHeading' => $blog['blogHeading'],
			'blogDate' => $blog['blogDate'],
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
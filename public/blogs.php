<?php

try {
  include __DIR__ . '/../includes/DatabaseConnection.php';
  include __DIR__ . '/../classes/DatabaseTable.php';


  $blogsTable = new DatabaseTable($pdo, 'blog', 'id');
  $authorsTable = new DatabaseTable($pdo, 'author', 'id');


  $result = $blogsTable->findAll();

  $blogs = [];
	foreach ($result as $blog) {
		$author = $authorsTable->findById($blog['authorId']);

    $blogs[] = [
			'id' => $blog['id'],
			'blogHeading' => $blog['blogHeading'],
			'blogDate' => $blog['blogDate'],
			'name' => $author['name'],
			'email' => $author['email']
		];

	}

  $title = 'Blog list';

  $totalBlogs = $blogsTable->total();

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
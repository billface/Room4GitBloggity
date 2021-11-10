<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="blogs.css">
    <title><?=$title?></title>
  </head>
  <body>
  <nav>
    <header>
      <h1>Internet Blog Database</h1>
    </header>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="blogs.php">Blog List</a></li>
      <li><a href="addblog.php">Add a new blog</a></li>
    </ul>
  </nav>

  <main>
  <?=$output?>
  </main>

  <footer>
  &copy; Bodged Websites 2020&ndash;<?php echo date('Y'); ?>
  </footer>

  </body>
</html>
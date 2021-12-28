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
      <li><a href="index.php?action=home">Home</a></li>
      <li><a href="index.php?action=about">About</a></li>
      <li><a href="index.php?action=events">Events</a></li>
      <li><a href="index.php?action=shop">Shop</a></li>
      <li><a href="index.php?action=list">Blog List</a></li>
      <li><a href="index.php?action=add">Add a new blog</a></li>
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
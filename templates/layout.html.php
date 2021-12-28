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
      <li><a href="index.php?action=home&id=1">Home</a></li>
      <li><a href="index.php?action=about&id=2">About</a></li>
      <li><a href="index.php?action=events&id=3">Events</a></li>
      <li><a href="index.php?action=shop&id=4">Shop</a></li>
      <li><a href="index.php?action=list&id=5">Blog List</a></li>
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
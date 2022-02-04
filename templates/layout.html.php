<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="blogs.css">
    <title><?=$title?></title>
    <meta name="description" content="<?=$metaDescription?>">
    </head>
  <body>
  <nav>
    <header>
      <h1>Internet Blog Database</h1>
    </header>

    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="/page/about">About</a></li>
      <li><a href="/blog/list">Blog List</a></li>
      <li><a href="/event/list">Calendar</a></li>
      <li><a href="/page/list">Pages</a></li>
      <li><a href="/blog/addpage">Add a new blog</a></li>
      <li><a href="/event/addpage">Add a new event</a></li>

      <?php if ($loggedIn): ?>
			<li><a href="/logout">Log out</a></li>
			<?php else: ?>
			<li><a href="/login">Log in</a></li>
			<?php endif; ?>
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
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/blogs.css">
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
  <?php  if ($user && $user->hasPermission(\Site\Entity\Author::SUPERUSER)): ?>
        <a href="/page/admin">&copy; Bodged Websites 2020&ndash;<?php echo date('Y'); ?></a>
        <?php else: ?>
         <p> &copy; Bodged Websites 2020&ndash;<?php echo date('Y'); ?> </p>
                <?php endif; ?>

  </footer>

  </body>
</html>
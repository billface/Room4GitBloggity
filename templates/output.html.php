<html>
  <head>
    <meta charset="utf-8">
    <title>List of blogs</title>
  </head>
  <body>
  <?php if (isset($error)): ?>
  <p>
    <?php echo $error; ?>
  </p>
  <?php else: ?>
  <?php foreach ($blogs as $blog): ?>
  <blockquote>
    <p>
    <?php echo htmlspecialchars($blog, ENT_QUOTES, 'UTF-8') ?>
    </p>
  </blockquote>
  <?php endforeach; ?>
  <?php endif; ?>
  </body>
</html>
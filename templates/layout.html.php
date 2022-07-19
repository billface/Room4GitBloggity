<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="blogs.css">
    <title><?=$title?></title>
    <meta name="description" content="<?=$metaDescription ?? ''?>">
    <meta name="robots" content="<?=$metaRobots?>" />
    <?php if ($tinyMCE === true) {
      echo '<script src="https://cdn.tiny.cloud/1/zodirmdh4azhpmm8dj7b93gd40xh6diyclb2ikh0qpekdw0j/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>';
    } ?>
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
      <li><a href="/item/list">Shop</a></li>
      
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

  <?php 
if ($paypal === true) {
     include __DIR__ . '/../includes/paypal/paypal.js.php' ;
 }

if ($tinyMCE === true) {
  echo "<script>
    tinymce.init({
      selector: 'textarea:not(.not-here)',
      plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter image editimage pageembed permanentpen table tableofcontents',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>";
}
 

 ?>
    

 <br>
  </body>
</html>
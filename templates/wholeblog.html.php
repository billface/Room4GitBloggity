
<blockquote>
<h2>
  <?=htmlspecialchars($blog['blogheading'], ENT_QUOTES, 'UTF-8')?>
</h2>
  <?=htmlspecialchars($blog['blogtext'], ENT_QUOTES, 'UTF-8')?><br>
  (by <a href="mailto:<?php
              echo htmlspecialchars($blog['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
              echo htmlspecialchars($blog['name'], ENT_QUOTES, 'UTF-8'); ?></a>
              on 
              <?php
              echo htmlspecialchars($blog['blogdate'], ENT_QUOTES, 'UTF-8'); ?>)
  
  </blockquote>
  <blockquote>
  <strong>Comments</strong><br>
  <?php foreach($comments as $comment): ?>
 <small> <?=htmlspecialchars($comment['commtext'], ENT_QUOTES, 'UTF-8')?>
 (by <a href="mailto:<?php
              echo htmlspecialchars($blog['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
              echo htmlspecialchars($blog['name'], ENT_QUOTES, 'UTF-8'); ?></a>)</small><br>

  


<?php  endforeach; ?>
</blockquote>

<?php

//cleans get variable if use on form
/*
if (is_numeric($_GET['id'])) {
	$commBlogIdValueForForm = $_GET['id'];
} else {
	$commBlogIdValueForForm = '';
}

*/

?>

<form action="" method="post">
    
    <label for="commtext">Type your comment here:</label>
    <textarea id="commtext" name="commtext" rows="3" cols="40"></textarea>
    <input type="hidden" name="commblogId" value="<?=$blog['blogId']?>">

    <input type="submit" value="Add">
    <br>
</form>
<br>
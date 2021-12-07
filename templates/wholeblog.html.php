
<blockquote>
<h2>
  <?=htmlspecialchars($blog['blogheading'], ENT_QUOTES, 'UTF-8')?>
</h2>
  <?=htmlspecialchars($blog['blogtext'], ENT_QUOTES, 'UTF-8')?><br>
  (by <a href="mailto:
              <?php echo htmlspecialchars($blog['email'], ENT_QUOTES, 'UTF-8'); ?>">
              <?php echo htmlspecialchars($blog['name'], ENT_QUOTES, 'UTF-8'); ?></a>
              on 
              <?php
              $date = new DateTime($blog['blogdate']);
              echo $date->format('jS F Y');
              ?>)
              
              <?php
              if (isset($blog['blogmoddate'])) {
                
                $date = new DateTime($blog['blogmoddate']);
                echo '<i>Edited ' .$date->format('jS F Y H:i'). '</i>)';
                
              }
              ?>)
              <a href="editblog.php?id=<?=$blog['blogId']?>">Edit</a>
  
  </blockquote>
  <blockquote>
  <strong>Comments</strong><br>
  <?php foreach($comments as $comment): ?>
 <small> <?=htmlspecialchars($comment['commtext'], ENT_QUOTES, 'UTF-8')?>
 (by <a href="mailto:<?php
              echo htmlspecialchars($blog['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
              echo htmlspecialchars($blog['name'], ENT_QUOTES, 'UTF-8'); ?></a>
              on 
              <?php
              $date = new DateTime($comment['commdate']);
              echo $date->format('jS F Y');
              ?>
              <?php 
              if (isset($comment['commmoddate'])) {
                $date = new DateTime($comment['commmoddate']);
                echo '<i>Edited ' .$date->format('jS F Y H:i'). '</i>)';
              }
              ?>)
              <a href="wholeblog.php?id=<?=$blog['blogId']?>&commentId=<?=$comment['id']?>">Edit</a></small><br>

  


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
<?php



if (isset($_GET['commentId'])) {
	//if (is_numeric($_GET['commentId'])) {

    echo
		'<form action="editcomment.php" method="post">
	<input type="hidden" name="commentsid" value="'.$comment2edit['id'].'">
  <input type="hidden" name="commblogId" value="'.$blog['blogId'].'">
    <label for="commtext">Type your comment here:</label>
    <textarea id="commtext" name="commtext" rows="3" cols="40">'.$comment2edit['commtext'].'</textarea>
    <input type="submit" value="Save">
</form>';

		
	//}
//	else {
		# load error, it's set but we don't have a valid comment id format
		
	//}
} else {
  echo '
	<form action="" method="post">
    
    <label for="commtext">Type your comment here:</label>
    <textarea id="commtext" name="commtext" rows="3" cols="40"></textarea>
    <input type="hidden" name="commblogId" value="'.$blog['blogId'].'">

    <input type="submit" value="Add"> 
    <br>
</form> ';
}

?>


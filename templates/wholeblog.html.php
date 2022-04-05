
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
              <form action="deleteblog.php" method="post">
                <input type="hidden" name="id" value="<?=$blog['blogId']?>">
                <input type="submit" value="Delete">
              </form>
              
  
  </blockquote>
  <blockquote>
  <strong>Comments</strong><br>
  <?php foreach($comments as $comment): ?>
 <small> <?=htmlspecialchars($comment['commText'], ENT_QUOTES, 'UTF-8')?>
 (by <a href="mailto:<?php
              echo htmlspecialchars($blog['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
              echo htmlspecialchars($blog['name'], ENT_QUOTES, 'UTF-8'); ?></a>
              on 
              <?php
              $date = new DateTime($comment['commDate']);
              echo $date->format('jS F Y');
              ?>
              <?php 
              if (isset($comment['commModDate'])) {
                $date = new DateTime($comment['commModDate']);
                echo '<i>Edited ' .$date->format('jS F Y H:i'). '</i>)';
              }
              ?>)
              <a href="wholeblog.php?id=<?=$blog['blogId']?>&commentId=<?=$comment['id']?>">Edit</a></small>
              <form action="deletecomment.php" method="post">
                <input type="hidden" name="id" value="<?=$comment['id']?>">
                <input type="hidden" name="blogId" value="<?=$blog['blogId']?>">
                <input type="submit" value="Delete">
              </form>
              <br>

  


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
	<input type="hidden" name="commentId" value="'.$comment2edit['id'].'">
  <input type="hidden" name="commBlogId" value="'.$comment2edit['commBlogId'].'">
    <label for="commText">Type your comment here:</label>
    <textarea id="commText" name="commText" rows="3" cols="40">'.$comment2edit['commText'].'</textarea>
    <input type="submit" value="Save">
</form>';

		
	//}
//	else {
		# load error, it's set but we don't have a valid comment id format
		
	//}
} else {
  echo '
	<form action="" method="post">
    
    <label for="commText">Type your comment here:</label>
    <textarea id="commText" name="commText" rows="3" cols="40"></textarea>
    <input type="hidden" name="commBlogId" value="'.$blog['blogId'].'">

    <input type="submit" value="Add"> 
    <br>
</form> ';
}

?>


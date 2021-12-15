
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
                <input type="hidden" name="id" value="<?=$blog['id']?>">
                <input type="submit" value="Delete">
              </form>
              
  
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



if (isset($_GET['commentId'])) {

    echo
		'<form action="editcomment.php" method="post">
	<input type="hidden" name="commentsid" value="'.$comment2edit['id'].'">
  <input type="hidden" name="commblogId" value="'.$comment2edit['commblogid'].'">
    <label for="commtext">Type your comment here:</label>
    <textarea id="commtext" name="commtext" rows="3" cols="40">'.$comment2edit['commtext'].'</textarea>
    <input type="submit" value="Save">
</form>';

		

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


<?php foreach($blogs as $blog): ?>
<blockquote>
<h2>
  <?=htmlspecialchars($blog['blogHeading'], ENT_QUOTES, 'UTF-8')?>
</h2>
  <?=htmlspecialchars($blog['blogText'], ENT_QUOTES, 'UTF-8')?><br>
  (by <a href="mailto:
              <?php echo htmlspecialchars($blog['email'], ENT_QUOTES, 'UTF-8'); ?>">
              <?php echo htmlspecialchars($blog['name'], ENT_QUOTES, 'UTF-8'); ?></a>
              on 
              <?php
              $date = new DateTime($blog['blogDate']);
              echo $date->format('jS F Y');
              
              if (isset($blog['blogModDate'])) {
                
                $date = new DateTime($blog['blogModDate']);
                echo ' (<i>Edited ' .$date->format('jS F Y H:i'). '</i>)';
               
              }
              ?>)
                  <?php if ($userId == $blog['authorId']): ?>
              <a href="/blog/edit?id=<?=$blog['id']?>">Edit</a>
              <form action="/blog/delete" method="post">
                <input type="hidden" name="blogId" value="<?=$blog['id']?>">
                <input type="submit" value="Delete">
              </form>
              <?php endif; ?>

              <?php endforeach; ?>
              
  
  </blockquote>
  <blockquote>
  <strong>Comments</strong><br>

  
  <?php foreach($comments as $comment): ?>
 <small> <?=htmlspecialchars($comment['commText'], ENT_QUOTES, 'UTF-8')?>
 (by <a href="mailto:<?php
              echo htmlspecialchars($comment['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
              echo htmlspecialchars($comment['name'], ENT_QUOTES, 'UTF-8'); ?></a>
              on 
              <?php
              $date = new DateTime($comment['commDate']);
                echo $date->format('jS F Y');
              
              if (isset($comment['commModDate'])) {
              $date = new DateTime($comment['commModDate']);
                echo ' (<i>Edited ' .$date->format('jS F Y H:i'). '</i>)';
              }
              ?>)</small>
                  <?php if ($userId == $comment['authorId']): ?>

              <a href="/blog/wholeblog?id=<?=$blog['id']?>&commentid=<?=$comment['id']?>">Edit</a>
              <form action="/blog/deletecomment" method="post">
                <input type="hidden" name="commId" value="<?=$comment['id']?>">
                <input type="hidden" name="headerBlogId" value="<?=$blog['id']?>">
                <input type="submit" value="Delete">
              </form>
              <?php endif; ?>

              <br>

  


<?php  endforeach; ?>
</blockquote>

<?php



if (isset($_GET['commentid'])) {
  if ($userId == $comment['authorId']): 

    echo
		'<form action="/blog/editcomment" method="post">
	    <input type="hidden" name="comment[id]" value="'.$comment2edit['id'].'">
      <input type="hidden" name="comment[commBlogId]" value="'.$comment2edit['commBlogId'].'">
      <label for="commText">Type your comment here:</label>
      <textarea id="commText" name="comment[commText]" rows="3" cols="40">'.$comment2edit['commText'].'</textarea>
      <input type="submit" value="Save">
    </form>';
     
  else:
    echo

    '<blockquote>You may only edit your own comments</blockquote>';
		 
  endif; 

} else {
  echo '
    <form action="/blog/addcomment" method="post">
      
      <label for="commText">Type your comment here:</label>
      <textarea id="commText" name="comment[commText]" rows="3" cols="40"></textarea>
      <input type="hidden" name="comment[commBlogId]" value="'.$blog['id'].'">
      <input type="submit" value="Add"> 
      <br>
    </form> ';
}

?>


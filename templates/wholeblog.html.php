<blockquote>
<h2>
<?=(new \Ninja\Markdown($blog->blogHeading))->toHtml()?>
</h2>
<?php if ($blog->blogVideo !== null) 
  echo '<iframe width="718" height="531" src="https://www.youtube.com/embed/'. $blog->blogVideo .'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>';
       ?>
<?=(new \Ninja\Markdown($blog->blogText))->toHtml()?>

  (by <a href="mailto:
              <?php 
              $author = $blog->getAuthor();
              echo htmlspecialchars($author ? $author->email : 'deleted user', ENT_QUOTES, 'UTF-8');
              ?>">
              <?php 
              $author = $blog->getAuthor();
              echo htmlspecialchars($author ? $author->name : 'deleted user', ENT_QUOTES, 'UTF-8');
              ?></a>
              on 
              <?php
              $date = new DateTime($blog->blogDate);
              echo $date->format('jS F Y');
              
              if (isset($blog->blogModDate)) {
                
                $date = new DateTime($blog->blogModDate);
                echo ' (<i>Edited ' .$date->format('jS F Y H:i'). '</i>)';
               
              }
              ?>)
                  <?php if ($user): ?>
      <?php if ($user->id == $blog->authorId || $user->hasPermission(\Site\Entity\Author::SUPERUSER)): ?>
      <a href="/blog/edit?id=<?=$blog->id?>">Edit</a>
      <?php endif; ?>
      <br>
      <?php if ($user->id == $blog->authorId || $user->hasPermission(\Site\Entity\Author::SUPERUSER)): ?>
      <form action="/blog/delete" method="post">
        <input type="hidden" name="blogId" value="<?=$blog->id?>">
        <input type="submit" value="Delete">
      </form>
    <?php endif; ?>
    <?php endif; ?>

              
  
  </blockquote>
  <blockquote>
  <strong>Comments</strong><br>

  
  <?php foreach($comments as $comment): ?>
 <small> 
   -
 <?=
 htmlspecialchars($comment->commText, ENT_QUOTES, 'UTF-8')
 //(new \Ninja\Markdown($comment->commText))->toHtml()

 ?>
 (by <?php
              $author = $comment->getAuthor();
              echo htmlspecialchars($author ? $author->name : 'deleted user', ENT_QUOTES, 'UTF-8');
              //echo htmlspecialchars($comment->getAuthor()->name, ENT_QUOTES, 'UTF-8') ?? 'deleted user'; ?></a>
              on 
              <?php
              $date = new DateTime($comment->commDate);
                echo $date->format('jS F Y');
              
              if (isset($comment->commModDate)) {
              $date = new DateTime($comment->commModDate);
                echo ' (<i>Edited ' .$date->format('jS F Y H:i'). '</i>)';
              }
              ?>)<br></small>
              <?php if ($user): ?>
                  <?php if ($user->id == $blog->authorId || $user->hasPermission(\Site\Entity\Author::ADMIN)): ?>
              <a href="/blog/wholeblog?id=<?=$blog->id?>&commentid=<?=$comment->id?>">Edit</a>
              
              <form action="/blog/deletecomment" method="post">
                <input type="hidden" name="commId" value="<?=$comment->id?>">
                <input type="hidden" name="headerBlogId" value="<?=$blog->id?>">
                <input type="submit" value="Delete">
              </form>
              <?php endif; ?>
              <?php endif; ?>

              <br>

  


<?php  endforeach; ?>
</blockquote>

<?php



if (isset($_GET['commentid'])) {
  if ($userId == $comment->authorId): 

    echo
		'<form action="/blog/editcomment" method="post">
	    <input type="hidden" name="comment[id]" value="'.$comment2edit->id.'">
      <input type="hidden" name="comment[commBlogId]" value="'.$comment2edit->commBlogId.'">
      <label for="commText">Type your comment here:</label>
      <textarea id="commText" name="comment[commText]" rows="3" cols="40">'.$comment2edit->commText.'</textarea>
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
      <input type="hidden" name="comment[commBlogId]" value="'.$blog->id.'">
      <input type="submit" value="Add"> 
      <br>
    </form> ';
}

?>


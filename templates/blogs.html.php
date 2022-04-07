

<p><?=$totalBlogs?> blogs have been added to the site </p>
<?php //echo '<pre>'; print_r($blogs); echo '</pre>'; ?>

<?php foreach($blogs as $blog): ?>
<blockquote>
  <p>
  <!--hidden form field so as not to display id of each blog
      form and input tags aren't outside the blockquote to simplify CSS -->
  <?=htmlspecialchars($blog['blogHeading'], ENT_QUOTES, 'UTF-8')?>

  (by <a href="mailto:<?php
              echo htmlspecialchars($blog['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
              echo htmlspecialchars($blog['name'], ENT_QUOTES, 'UTF-8'); ?></a> 
              on 
              <?php
              $date = new DateTime($blog['blogDate']);
              echo $date->format('jS F Y');
              ?>)

  <a href="index.php?action=edit&id=<?=$blog['id']?>">Edit</a>
  <br>
  <a href="index.php?action=wholeBlog&id=<?=$blog['id']?>">See more</a>
  <form action="index.php?action=delete" method="post">
    <input type="hidden" name="blogId" value="<?=$blog['id']?>">
    <input type="submit" value="Delete">
  </form>
  </p>
</blockquote>
<?php endforeach; ?>
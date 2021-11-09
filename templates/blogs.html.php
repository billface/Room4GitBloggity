<p><?=$totalBlogs?> blogs have been added to the site </p>

<?php foreach($blogs as $blog): ?>
<blockquote>
  <p>
  <!--hidden form field so as not to display id of each blog
      form and input tags aren't outside the blockquote to simplify CSS -->
  <?=htmlspecialchars($blog['blogtext'], ENT_QUOTES, 'UTF-8')?>

  (by <a href="mailto:<?php
              echo htmlspecialchars($blog['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
              echo htmlspecialchars($blog['name'], ENT_QUOTES, 'UTF-8'); ?></a>)

  <a href="editblog.php?id=<?=$blog['id']?>">Edit</a>
  <br>
  <a href="wholeblog.php?id=<?=$blog['id']?>">See more</a>
  <form action="deleteblog.php" method="post">
    <input type="hidden" name="id" value="<?=$blog['id']?>">
    <input type="submit" value="Delete">
  </form>
  </p>
</blockquote>
<?php endforeach; ?>
<?php foreach($blogs as $blog): ?>
<blockquote>
  <p>
  <!--hidden form field so as not to display id of each joke
      form and input tags aren't outside the blockquote to simplify CSS -->
  <?=htmlspecialchars($blog['blogtext'], ENT_QUOTES, 'UTF-8')?>
  <form action="deleteblog.php" method="post">
    <input type="hidden" name="id" value="<?=$blog['id']?>">
    <input type="submit" value="Delete">
  </form>
  </p>
</blockquote>
<?php endforeach; ?>
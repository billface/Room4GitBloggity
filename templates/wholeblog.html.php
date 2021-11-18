
<blockquote>
<h2>
  <?=htmlspecialchars($blog['blogheading'], ENT_QUOTES, 'UTF-8')?>
</h2>
  <?=htmlspecialchars($blog['blogtext'], ENT_QUOTES, 'UTF-8')?>
  (by <a href="mailto:<?php
              echo htmlspecialchars($blog['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
              echo htmlspecialchars($blog['name'], ENT_QUOTES, 'UTF-8'); ?></a>)
  </p>
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

<form action="" method="post">
    
    <label for="commText">Type your comment here:</label>
    <textarea id="commText" name="commText" rows="3" cols="40"></textarea>
    <input type="hidden" name="commBlogid" value="6">
    <input type="submit" value="Add">
    <br>
</form>
<br>
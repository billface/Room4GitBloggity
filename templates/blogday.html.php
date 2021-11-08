<?php foreach($blogs as $blog): ?>
<blockquote>
  <p>
  <?=htmlspecialchars($blog, ENT_QUOTES, 'UTF-8')?>
  </p>
</blockquote>
<?php endforeach; ?>
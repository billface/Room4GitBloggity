<?php // foreach($blogs as $blog): ?>
<blockquote>
  <p>
  <?=htmlspecialchars($blog['blogtext'], ENT_QUOTES, 'UTF-8')?>
  (by <a href="mailto:<?php
              echo htmlspecialchars($blog['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
              echo htmlspecialchars($blog['name'], ENT_QUOTES, 'UTF-8'); ?></a>)
  </p>
</blockquote>
<?php // endforeach; ?>
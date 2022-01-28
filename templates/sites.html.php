<?php foreach($pages as $page): ?>
<blockquote>
  <p>
  

  <!--hidden form field so as not to display id of each page
      form and input tags aren't outside the blockquote to simplify CSS -->
  <?=htmlspecialchars($page['pageHeading'], ENT_QUOTES, 'UTF-8')?>
  <br>
  <?=htmlspecialchars($page['pageText'], ENT_QUOTES, 'UTF-8')?>


  (by <a href="mailto:<?php
              echo htmlspecialchars($page['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
              echo htmlspecialchars($page['name'], ENT_QUOTES, 'UTF-8'); ?></a>)
            
            <a href="/page/wholepage?id=<?=$page['id']?>">See more</a>

    <?php if ($userId == $page['authorId']): ?>
      <a href="/site/edit?id=<?=$page['id']?>">Edit</a>
      <br>
    <?php endif; ?>

</p>
</blockquote>
<?php endforeach; ?>
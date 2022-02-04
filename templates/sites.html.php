<?php foreach($sites as $site): ?>
<blockquote>
  <p>
  

  <!--hidden form field so as not to display id of each page
      form and input tags aren't outside the blockquote to simplify CSS -->
  <?=htmlspecialchars($site['siteHeading'], ENT_QUOTES, 'UTF-8')?>
  <br>
  <?=htmlspecialchars($site['siteText'], ENT_QUOTES, 'UTF-8')?>


  (by <a href="mailto:<?php
              echo htmlspecialchars($site['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
              echo htmlspecialchars($site['name'], ENT_QUOTES, 'UTF-8'); ?></a>)
            
            <a href="/site/wholesite?id=<?=$site['id']?>">See more</a>

    <?php if ($userId == $site['authorId']): ?>
      <a href="/site/edit?id=<?=$site['id']?>">Edit</a>
      <br>
    <?php endif; ?>

</p>
</blockquote>
<?php endforeach; ?>
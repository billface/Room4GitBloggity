<?php //echo '<pre>'; print_r($items); echo '</pre>'; ?>

<?php foreach($items as $item): ?>
<blockquote>
  <h2>
  
  <?=(new \Ninja\Markdown($item->itemHeading))->toHtml()?>


</h2>
<?php if ($item->itemPicture !== null) 

echo '<blockquote class="imgur-embed-pub" lang="en" data-id="'.$item->itemPicture.'" data-context="false" ><a href="//imgur.com/a/'. $item->itemPicture. '"></a></blockquote><script async src="//s.imgur.com/min/embed.js" charset="utf-8"></script>'
    ?>
              <p>
    <?=(new \Ninja\Markdown($item->itemText))->toHtml()?>

 
</p>

  (by <a href="mailto:<?php

              $author = $item->getAuthor();
              echo htmlspecialchars($author ? $author->email : 'deleted user', ENT_QUOTES, 'UTF-8');
              ?>">
              <?php
              $author = $item->getAuthor();
              echo htmlspecialchars($author ? $author->name : 'deleted user', ENT_QUOTES, 'UTF-8');
               ?></a>)

<h3>
    <?php
              $stock = ($item->itemStock);
              echo $stock;
              ?>
              </h3>


<?php if ($user): ?>
  <?php if ($user->id == $item->authorId || $user->hasPermission(\Site\Entity\Author::SUPERUSER)): ?>
  <a href="/item/edit?id=<?=$item->id?>">Edit</a>
  <?php endif; ?>

  <br>
  <?php if ($user->id == $item->authorId || $user->hasPermission(\Site\Entity\Author::SUPERUSER)): ?>
    <form action="/item/delete" method="post">
    <input type="hidden" name="itemId" value="<?=$item->id?>">
    <input type="submit" value="Delete">
  </form>
  <?php endif; ?>
  <?php endif; ?>


  </p>
</blockquote>
<?php endforeach; ?>
<?php foreach($pages as $page): ?>
<blockquote>
  <p>
  

  <!--hidden form field so as not to display id of each page
      form and input tags aren't outside the blockquote to simplify CSS -->
  <?=htmlspecialchars($page->pageHeading, ENT_QUOTES, 'UTF-8')?>
  <br>
  <?=htmlspecialchars($page->pageText, ENT_QUOTES, 'UTF-8')?>


  (by <a href="mailto:<?php
              $author = $page->getAuthor();
              echo htmlspecialchars($author ? $author->email : 'deleted user', ENT_QUOTES, 'UTF-8');
              ?>">
              <?php
              $author = $page->getAuthor();
              echo htmlspecialchars($author ? $author->name : 'deleted user', ENT_QUOTES, 'UTF-8');
               ?></a>)
            

            <?php if ($user): ?>
  <?php if ($user->id == $page->authorId || $user->hasPermission(\Site\Entity\Author::SUPERUSER)): ?>      <a href="/page/edit?id=<?=$page->id?>">Edit</a>
      <br>
    <?php endif; ?>
    <?php endif; ?>


</p>
</blockquote>
<?php endforeach; ?>
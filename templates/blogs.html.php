<ul class="categories">
  <?php foreach($categories as $category): ?>
    <li><a href="/blog/list?category=<?=$category->id?>"><?=$category->name?></a><li>
  <?php endforeach; ?>
</ul>

<p><?=$totalBlogs?> blogs have been added to the site </p>

<?php foreach($blogs as $blog): ?>
<blockquote>
  <p>
  

  <!--hidden form field so as not to display id of each blog
      form and input tags aren't outside the blockquote to simplify CSS -->
  <?=$blog->blogHeading?>

  (by <a href="mailto:<?php
              $author = $blog->getAuthor();
              echo htmlspecialchars($author ? $author->email : 'deleted user', ENT_QUOTES, 'UTF-8');
              ?>">
              <?php 
              $author = $blog->getAuthor();
              echo htmlspecialchars($author ? $author->name : 'deleted user', ENT_QUOTES, 'UTF-8');
              ?></a>
              on 
              <?php
              $date = new DateTime($blog->blogDate);
              echo $date->format('jS F Y');
              ?>)
            
            <a href="/blog/wholeblog?id=<?=$blog->id?>">See more</a>

    <?php if ($user): ?>
      <?php if ($user->id == $blog->authorId || $user->hasPermission(\Site\Entity\Author::SUPERUSER)): ?>
      <a href="/blog/edit?id=<?=$blog->id?>">Edit</a>
      <?php endif; ?>
    <br>
      <?php if ($user->id == $blog->authorId || $user->hasPermission(\Site\Entity\Author::SUPERUSER)): ?>
      <form action="/blog/delete" method="post">
        <input type="hidden" name="blogId" value="<?=$blog->id?>">
        <input type="submit" value="Delete">
      </form>
      <?php endif; ?>
    <?php endif; ?>


</p>
</blockquote>
<?php endforeach; ?>

Select page: 

<?php

$numIndex = ceil($totalBlogs/10);

for ($i = 1; $i <= $numIndex; $i++):
  if ($i == $currentIndex):
?>
  <a class="currentindex" href="/blog/list?index=<?=$i?><?=!empty($categoryId) ? '&category=' . $categoryId : '' ?>"><?=$i?></a>
<?php else: ?>
  <a href="/blog/list?index=<?=$i?><?=!empty($categoryId) ? '&category=' . $categoryId : '' ?>"><?=$i?></a>
<?php endif; ?>
<?php endfor; ?>
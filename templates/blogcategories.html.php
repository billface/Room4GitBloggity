
<h2>Blog Categories</h2>

<a href="/blogcategory/edit">Add a new blog category</a>


<?php foreach($blogCategories as $blogCategory): ?>
<blockquote>
  <p>
  <?=htmlspecialchars($blogCategory->name, ENT_QUOTES, 'UTF-8')?>

  <a href="/blogcategory/edit?id=<?=$blogCategory->id?>">Edit</a>
  <form action="/blogcategory/delete" method="post">
    <input type="hidden" name="id" value="<?=$blogCategory->id?>">
    <input type="submit" value="Delete">
  </form>
  </p>
</blockquote>

<?php endforeach; ?>

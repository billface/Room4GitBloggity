<h2>Item Colours / Names</h2>
<a href="/item/edit">Back to listing page</a>
<br>
<a href="/itemdesc/edit">Add a new colour / name</a>

<?php foreach($itemdescs as $itemdesc): ?>
<blockquote>
  <p>
  <?=htmlspecialchars($itemdesc->name, ENT_QUOTES, 'UTF-8')?>

  <a href="/itemdesc/edit?id=<?=$itemdesc->id?>">Edit</a>
  <form action="/itemdesc/delete" method="post">
    <input type="hidden" name="id" value="<?=$itemdesc->id?>">
    <input type="submit" value="Delete">
  </form>
  </p>
</blockquote>

<?php endforeach; ?>
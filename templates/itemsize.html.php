
<h2>Item Sizes</h2>

<a href="/itemsize/edit">Add a new size</a>

<?php foreach($itemsizes as $itemsize): ?>
<blockquote>
  <p>
  <?=htmlspecialchars($itemsize->name, ENT_QUOTES, 'UTF-8')?>

  <a href="/itemsize/edit?id=<?=$itemsize->id?>">Edit</a>
  <form action="/itemsize/delete" method="post">
    <input type="hidden" name="id" value="<?=$itemsize->id?>">
    <input type="submit" value="Delete">
  </form>
  </p>
</blockquote>

<?php endforeach; ?>

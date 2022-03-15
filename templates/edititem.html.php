<?php if (empty($item->id) || $user->id == $item->authorId || $user->hasPermission(\Site\Entity\Author::SUPERUSER)) : ?>

<form action="" method="post">
	<input type="hidden" name="item[id]" value="<?=$item->id?>">
    <label for="itemHeading">Type your item heading here:</label>
    <textarea id="itemHeading" name="item[itemHeading]" rows="1" cols="40"><?=$item->itemHeading?></textarea>
    <br>
    <label for="itemText">Type your item content here:</label>
    <textarea id="itemText" name="item[itemText]" rows="3" cols="40"><?=$item->itemText?></textarea>
    <br>
    <label for="itemPicture">Enter your picture URL here:</label>
    <textarea id="itemPicture" name="item[itemPicture]" rows="3" cols="40"><?=$item->itemPicture?>
    </textarea>
    <label for="itemStock">Stock</label>
    <input type="number" id="item[itemStock]" name="item[itemStock]">Currently <?=$item->itemStock?>
    <br>
    
    <input type="submit" value="Save">
</form>
<?php else: ?>

<p>You may only edit events that you posted.</p>
<?php endif; ?>
<?php if ($userId == $item['authorId']): ?>


<form action="" method="post">
    <input type="hidden" name="item[id]" value="<?=$item['id']?>">
    <label for="itemHeading">Type your item heading here:</label>
    <textarea id="itemHeading" name="item[itemHeading]" rows="1" cols="40"><?=$item['itemHeading']?></textarea>
    <br>
    <label for="itemText">Type your item content here:</label>
    <textarea id="itemText" name="item[itemText]" rows="3" cols="40"><?=$item['itemText']?></textarea>
    <br>
    <label for="itemPicture">Type your item picture code here:</label>
    <textarea id="itemPicture" name="item[itemPicture]" rows="1" cols="40"><?=$item['itemPicture']?></textarea>
    <br>
    <label for="itemStock">Stock</label>
    <input type="number" id="item[itemStock]" name="item[itemStock]" value="<?=$item['itemStock']?>">
    <br>
    <label for="itemPrice">Price</label>
    <input type="number" id="item[itemPrice]" name="item[itemPrice]" value="<?=$item['itemPrice']?>">
    <br>
    <label for="itemShipping">Shipping</label>
    <input type="number" id="item[itemShipping]" name="item[itemShipping]" value="<?=$item['itemShipping']?>">
    <input type="submit" value="Save">

</form>
<?php else: ?>

<p>You may only edit events that you posted.</p>
<?php endif; ?>

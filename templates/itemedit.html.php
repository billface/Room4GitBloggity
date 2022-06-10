<?php 
if (empty($item->id) || $userId == $item->authorId): 

if (isset($_SESSION['itemErrorMessage'])) {
    echo '<p>You got these errors :'. $_SESSION['itemErrorMessage']. '</p>';
    unset($_SESSION['itemErrorMessage']);
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="item[id]" value="<?=$item->id ?? ''?>">
    <label for="itemHeading">Type your item heading here:</label>
    <textarea id="itemHeading" name="item[itemHeading]" rows="1" cols="40"><?=$item->itemHeading ?? $_SESSION['item']['itemHeading'] ?? ''?></textarea>
    <br>
    <label for="itemPaypalDescription">Type your item subtitle (/Paypal descritption) here:</label>
    <textarea id="itemPaypalDescription" name="item[itemPaypalDescription]" rows="3" cols="40"><?=$item->itemPaypalDescription ?? $_SESSION['item']['itemPaypalDescription'] ?? ''?></textarea>
    <br>
    <label for="itemText">Type your item content here:</label>
    <textarea id="itemText" name="item[itemText]" rows="3" cols="40"><?=$item->itemText ?? $_SESSION['item']['itemText'] ?? ''?></textarea>
    <br>
    <label for="itemPicture">Type your item picture code here:</label>
    <textarea id="itemPicture" name="item[itemPicture]" rows="1" cols="40"><?=$item->itemPicture ?? $_SESSION['item']['itemPicture'] ?? ''?></textarea>
    <br>
    <p>Select sizes for this item:</p>
    <?php foreach ($itemsizes as $itemsize): ?>

    <?php if ($item && $item->hasSize($itemsize->id)): ?>
    <input type="checkbox" checked name="itemsize[]" value="<?=$itemsize->id?>" />
    <?php else: ?>

    <input type="checkbox" name="itemsize[]" value="<?=$itemsize->id?>" /> 
    <?php endif; ?>
    <label><?=$itemsize->name?></label>
    <?php endforeach; ?>
    <br>
    <a href="/itemsize/edit">Add a new size</a>
    <br>
    <label for="itemStock">Stock</label>
    <input type="number" id="item[itemStock]" name="item[itemStock]" value="<?=$item->itemStock ?? $_SESSION['item']['itemStock'] ?? ''?>">
    <br>
    <label for="itemPrice">Price</label>
    <input type="number" id="item[itemPrice]" name="item[itemPrice]" value="<?=$item->itemPrice ?? $_SESSION['item']['itemPrice'] ?? ''?>">
    <br>
    <label for="itemShipping">Shipping</label>
    <input type="number" id="item[itemShipping]" name="item[itemShipping]" value="<?=$item->itemShipping ?? $_SESSION['item']['itemShipping'] ?? ''?>">
    <br>
    <label for="itemImage">Image Upload</label>
    <input type="file" name="file">
    <br>
    <input type="submit" value="Save">

</form>
<?php unset($_SESSION['item']); ?>
<?php else: ?>

<p>You may only edit events that you posted.</p>
<?php endif; ?>

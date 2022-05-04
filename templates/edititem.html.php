<?php 
if ($userId == $item['authorId']): 

if (isset($_SESSION['itemErrorMessage'])) {
    echo '<p>You got these errors :'. $_SESSION['itemErrorMessage']. '</p>';
    unset($_SESSION['itemErrorMessage']);
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="item[id]" value="<?=$item['id']?>">
    <label for="itemHeading">Type your item heading here:</label>
    <textarea id="itemHeading" name="item[itemHeading]" rows="1" cols="40"><?=$_SESSION['item']['itemHeading'] ?? $item['itemHeading']?></textarea>
    <br>
    <label for="itemText">Type your item content here:</label>
    <textarea id="itemText" name="item[itemText]" rows="3" cols="40"><?=$_SESSION['item']['itemText'] ?? $item['itemText']?></textarea>
    <br>
    <label for="itemPicture">Type your item picture code here:</label>
    <textarea id="itemPicture" name="item[itemPicture]" rows="1" cols="40"><?=$_SESSION['item']['itemPicture'] ?? $item['itemPicture']?></textarea>
    <br>
    <label for="itemStock">Stock</label>
    <input type="number" id="item[itemStock]" name="item[itemStock]" value="<?=$_SESSION['item']['itemStock'] ?? $item['itemStock']?>">
    <br>
    <label for="itemPrice">Price</label>
    <input type="number" id="item[itemPrice]" name="item[itemPrice]" value="<?=$_SESSION['item']['itemPrice'] ?? $item['itemPrice']?>">
    <br>
    <label for="itemShipping">Shipping</label>
    <input type="number" id="item[itemShipping]" name="item[itemShipping]" value="<?=$_SESSION['item']['itemShipping'] ?? $item['itemShipping']?>">
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

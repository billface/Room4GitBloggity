<?php //if stagement to display errors 
    if (isset($_SESSION['itemErrorMessage'])) {
        echo '<p>You got these errors :'. $_SESSION['itemErrorMessage']. '</p>';
        unset($_SESSION['itemErrorMessage']);
    }
?>
   

<form action="/item/add" method="post" enctype="multipart/form-data">
    <input type="hidden" name="item[id]" value="<?=''?>">
    <label for="itemHeading">Type your item heading here:</label>
    <textarea id="itemHeading" name="item[itemHeading]" rows="1" cols="40"><?=$_SESSION['item']['itemHeading'] ?? ''?></textarea>
    <br>
    <label for="itemPaypalDescription">Type your item subtitle (/Paypal descritption) here:</label>
    <textarea id="itemPaypalDescription" name="item[itemPaypalDescription]" rows="3" cols="40"><?=$_SESSION['item']['itemPaypalDescription'] ?? ''?></textarea>
    <br>
    <label for="itemText">Type your item content here:</label>
    <textarea id="itemText" name="item[itemText]" rows="3" cols="40"><?=$_SESSION['item']['itemText'] ?? ''?></textarea>
    <br>
    <label for="itemPicture">Type your item picture name here (no spaces):</label>
    <textarea id="itemPicture" name="item[itemPicture]" rows="1" cols="40"><?=$_SESSION['item']['itemPicture'] ?? ''?></textarea>
    <br>
    <label for="itemStock">Stock</label>
    <input type="number" id="item[itemStock]" name="item[itemStock]" value="<?=$_SESSION['item']['itemStock'] ?? ''?>">
    <br>
    <label for="itemPrice">Price</label>
    <input type="number" id="item[itemPrice]" name="item[itemPrice]" value="<?=$_SESSION['item']['itemPrice'] ?? ''?>">
    <br>
    <label for="itemShipping">Shipping</label>
    <input type="number" id="item[itemShipping]" name="item[itemShipping]" value="<?=$_SESSION['item']['itemShipping'] ?? ''?>">
    <br>
    <label for="itemImage">Image Upload</label>
    <input type="file" name="file">
    <br>
    <input type="submit" value="Add">


</form>
<br>
<?php unset($_SESSION['item']); ?>
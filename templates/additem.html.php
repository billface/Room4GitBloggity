<form action="/item/add" method="post" enctype="multipart/form-data">
    <input type="hidden" name="item[id]" value="<?=''?>">
    <label for="itemHeading">Type your item heading here:</label>
    <textarea id="itemHeading" name="item[itemHeading]" rows="1" cols="40"></textarea>
    <br>
    <label for="itemText">Type your item content here:</label>
    <textarea id="itemText" name="item[itemText]" rows="3" cols="40"></textarea>
    <br>
    <label for="itemPicture">Type your item picture name here (no spaces):</label>
    <textarea id="itemPicture" name="item[itemPicture]" rows="1" cols="40"></textarea>
    <br>
    <label for="itemStock">Stock</label>
    <input type="number" id="item[itemStock]" name="item[itemStock]">
    <br>
    <label for="itemPrice">Price</label>
    <input type="number" id="item[itemPrice]" name="item[itemPrice]">
    <br>
    <label for="itemShipping">Shipping</label>
    <input type="number" id="item[itemShipping]" name="item[itemShipping]">
    <br>
    <label for="file">Image Upload</label>
    <input type="file" name="file">
    <br>
    <input type="submit" value="Add">


</form>
<br>
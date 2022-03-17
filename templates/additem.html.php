<form action="/item/add" method="post">
    <input type="hidden" name="item[id]" value="<?=''?>">
    <label for="itemHeading">Type your item heading here:</label>
    <textarea id="itemHeading" name="item[itemHeading]" rows="1" cols="40"></textarea>
    <br>
    <label for="itemText">Type your item content here:</label>
    <textarea id="itemText" name="item[itemText]" rows="3" cols="40">
    </textarea>
    <br>
    <label for="itemPicture">Enter your picture URL here (GDrive, copy, bit after /d/):</label>
    <textarea id="itemPicture" name="item[itemPicture]" rows="3" cols="40">
    </textarea>
    <br>
    <label for="itemDate">Stock</label>
    <input type="number" id="item[itemStock]" name="item[itemStock]">
    <!--<br>
    <label for="eventDate">Event date:</label>
    <input type="datetime-local" id="eventDate"  name="event['eventDate']">
-->
    
    <input type="submit" value="Add">
    <br>
</form>
<br>
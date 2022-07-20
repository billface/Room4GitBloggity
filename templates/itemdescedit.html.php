<form action="" method="post">
	<input type="hidden" name="itemdesc[id]" value="<?=$itemdesc->id ?? ''?>">
	<label for="itemdescname">Enter item description:</label>
	<input type="text" id="itemdescname" name="itemdesc[name]" value="<?=$itemdesc->name ?? ''?>" />
	<input type="submit" name="submit" value="Save">
</form>
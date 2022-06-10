<form action="" method="post">
	<input type="hidden" name="itemsize[id]" value="<?=$itemsize->id ?? ''?>">
	<label for="itemsizename">Enter size name:</label>
	<input type="text" id="itemsizename" name="itemsize[name]" value="<?=$itemsize->name ?? ''?>" />
	<input type="submit" name="submit" value="Save">
</form>
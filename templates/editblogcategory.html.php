<form action="" method="post">
	<input type="hidden" name="blogCategory[id]" value="<?=$blogCategory->id ?? ''?>">
	<label for="blogCategoryName">Enter category name:</label>
	<input type="text" id="blogCategoryName" name="blogCategory[name]" value="<?=$blogCategory->name ?? ''?>" />
	<input type="submit" name="submit" value="Save">
</form>

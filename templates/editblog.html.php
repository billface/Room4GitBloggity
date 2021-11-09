<form action="" method="post">
	<input type="hidden" name="blogid" value="<?=$blog['id'];?>">
    <label for="blogtext">Type your blog here:</label>
    <textarea id="blogtext" name="blogtext" rows="3" cols="40"><?=$blog['blogtext']?></textarea>
    <input type="submit" value="Save">
</form>
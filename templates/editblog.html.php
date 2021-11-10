<form action="" method="post">
	<input type="hidden" name="blogid" value="<?=$blog['id'];?>">
    <label for="blogheading">Type your blog heading here:</label>
    <textarea id="blogheading" name="blogheading" rows="1" cols="40"></textarea>
    <br>
    <label for="blogtext">Type your blog here:</label>
    <textarea id="blogtext" name="blogtext" rows="3" cols="40"><?=$blog['blogtext']?></textarea>
    <input type="submit" value="Save">
</form>
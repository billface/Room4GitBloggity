<form action="" method="post">
	<input type="hidden" name="blogId" value="<?=$blog['id'];?>">
    <label for="blogHeading">Type your blog heading here:</label>
    <textarea id="blogHeading" name="blogHeading" rows="1" cols="40"><?=$blog['blogHeading']?></textarea>
    <br>
    <label for="blogText">Type your blog here:</label>
    <textarea id="blogText" name="blogText" rows="3" cols="40"><?=$blog['blogText']?></textarea>
    <input type="submit" value="Save">
</form>
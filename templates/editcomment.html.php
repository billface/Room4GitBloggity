<form action="" method="post">
	<input type="hidden" name="commentsid" value="<?=$comment['id'];?>">
    
    <label for="commtext">Type your comment here:</label>
    <textarea id="commtext" name="commtext" rows="3" cols="40"><?=$comment['commtext']?></textarea>
    <input type="submit" value="Save">
</form>
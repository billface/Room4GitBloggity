<?php if ($userId == $site['authorId']): ?>

<form action="" method="post">
	<input type="hidden" name="site[id]" value="<?=$site['id']?>">
    <label for="siteHeading">Type your page heading here:</label>
    <textarea id="siteHeading" name="site[siteHeading]" rows="1" cols="40"><?=$site['siteHeading']?></textarea>
    <br>
    <label for="siteText">Type your page text here:</label>
    <textarea id="siteText" name="site[siteText]" rows="3" cols="40"><?=$site['siteText']?></textarea>
    <br>
    
    <input type="submit" value="Save">
</form>
<?php else: ?>

<p>You may only edit pages that you control.</p>
<?php endif; ?>
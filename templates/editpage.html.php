<?php if ($userId == $page['authorId']): ?>

<form action="" method="post">
	<input type="hidden" name="page[id]" value="<?=$page['id']?>">
    <label for="pageHeading">Type your page heading here:</label>
    <textarea id="pageHeading" name="page[pageHeading]" rows="1" cols="40"><?=$page['pageHeading']?></textarea>
    <br>
    <label for="pageText">Type your page text here:</label>
    <textarea id="pageText" name="page[pageText]" rows="3" cols="40"><?=$page['pageText']?></textarea>
    <br>
    <br>
    <label for="metaDescription">Type your metaDescription here:</label>
    <textarea id="metaDescription" name="page[metaDescription]" rows="3" cols="40"><?=$page['metaDescription']?></textarea>
    
    <input type="submit" value="Save">
</form>
<?php else: ?>

<p>You may only edit pages that you control.</p>
<?php endif; ?>
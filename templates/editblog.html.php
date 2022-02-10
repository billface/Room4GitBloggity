<?php if ($userId == $blog->authorId): ?>

<form action="" method="post">
	<input type="hidden" name="blog[id]" value="<?=$blog->id?>">
    <input type="hidden" name="headerBlogId" value="<?=$blog->id?>">
    <label for="blogHeading">Type your blog heading here:</label>
    <textarea id="blogHeading" name="blog[blogHeading]" rows="1" cols="40"><?=$blog->blogHeading?></textarea>
    <br>
    <label for="blogText">Type your blog here:</label>
    <textarea id="blogText" name="blog[blogText]" rows="3" cols="40"><?=$blog->blogText?></textarea>
    <br>
    <label for="metaDescription">Type your metaDescription here:</label>
    <textarea id="metaDescription" name="blog[metaDescription]" rows="3" cols="40"><?=$blog->metaDescription?></textarea>
    <br>

    <p>Select categories for this joke:</p>
    <?php foreach ($blogCategories as $blogCategory): ?>
    <input type="checkbox" name="blogCategory[]" value="<?=$blogCategory->id?>" /> <label><?=$blogCategory->name?></label>


    <?php endforeach; ?>
    <input type="submit" value="Save">
</form>
<?php else: ?>

<p>You may only edit jokes that you posted.</p>
<?php endif; ?>



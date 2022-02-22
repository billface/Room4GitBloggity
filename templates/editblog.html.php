<?php if (empty($blog->id) || $user->id == $blog->authorId || $user->hasPermission(\Site\Entity\Author::EDIT_BLOGS)) : ?>

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

    <p>Select categories for this blog:</p>
    <?php foreach ($categories as $category): ?>

    <?php if ($blog && $blog->hasCategory($category->id)): ?>
    <input type="checkbox" checked name="category[]" value="<?=$category->id?>" />
    <?php else: ?>
    <input type="checkbox" name="category[]" value="<?=$category->id?>" /> 
    <?php endif; ?>

    <label><?=$category->name?></label>
    <?php endforeach; ?>
    <br>
    <input type="submit" value="Save">
</form>
<?php else: ?>

<p>You may only edit blogs that you posted.</p>
<?php endif; ?>



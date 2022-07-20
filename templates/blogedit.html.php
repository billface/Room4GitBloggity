
<?php if (empty($blog->id) || $user->id == $blog->authorId || $user->hasPermission(\Site\Entity\Author::SUPERUSER)) : 

    if (isset($_SESSION['uploadErrorMessage'])) {
    echo '<p>You got these errors :'. $_SESSION['uploadErrorMessage']. '</p>';
    unset($_SESSION['uploadErrorMessage']);
    
}

?>

<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="blog[id]" value="<?=$blog->id ?? ''?>">
    <input type="hidden" name="headerBlogId" value="<?=$blog->id ?? ''?>">
    <label for="blogHeading">Type your blog heading here:</label>
    <textarea id="blogHeading" name="blog[blogHeading]" rows="1" cols="40"><?=$blog->blogHeading ?? $_SESSION['blog']['blogHeading'] ?? ''?></textarea>
    <br>
    <label for="blogText">Type your blog here:</label>
    <textarea id="blogText" name="blog[blogText]" rows="3" cols="40"><?=$blog->blogText ?? $_SESSION['blog']['blogText'] ?? ''?></textarea>
    
    <br>
    
    <label for="metaDescription">Type your metaDescription here:</label>
    <textarea id="metaDescription" name="blog[metaDescription]" class="not-here" rows="3" cols="40"><?=$blog->metaDescription ?? $_SESSION['blog']['metaDescription']?? ''?></textarea>
    <br>
    <p>Select categories for this blog:</p>
    

    <?php
		foreach ($categories as $category) { 
			$doWeHaveACategoryMatch = 'no';
					
			if ($blog && $blog->hasCategory($category->id)){
				echo '<input type="checkbox" checked name="category[]" value="'.$category->id.'" />';
					 
			} else if (isset($_SESSION['blogCategory'])) {
				foreach ($_SESSION['blogCategory'] as $blogCatSelected) {
					if ($blogCatSelected == $category->id) {
						$doWeHaveACategoryMatch = 'yes';
					}
				}
				if ($doWeHaveACategoryMatch == 'yes') {
					echo '<input type="checkbox" checked name="category[]" value="'.$category->id.'" />'; 
				} else {
					echo '<input type="checkbox" name="category[]" value="'.$category->id.'" />'; 
				}
			} else {
				echo '<input type="checkbox" name="category[]" value="'.$category->id.'" />'; 
			}

			echo '<label>'.$category->name.'</label>';
		}
		?>

    
    <br>
    <label for="blogVideo">YouTube video link ( the last bit after the v= ):</label>
    <textarea id="blogVideo" name="blog[blogVideo]" class="not-here" rows="1" cols="40"><?=$blog->blogVideo  ?? $_SESSION['blog']['blogVideo'] ?? ''?></textarea>
    
    <br>
    <label for="blogImageName">Type your blog image name here (noSpaces):</label>
    <textarea id="blogImageName" name="blog[blogImageName]" class="not-here" rows="1" cols="40"><?=$blog->blogImageName ?? $_SESSION['blog']['blogImageName'] ?? ''?></textarea>
    <p>[if adding image and video => image is shown on the list, video is shown in the post]</p>
    <label for="blogImage">Image Upload</label>
    <input type="file" name="file">

    <!-- to allow edited upload fail to refill values -->
    <input type="hidden" name="hiddenId" value="<?=$_GET['id'] ?? ''?>">

    <br>
    <input type="submit" value="Save">
</form>
<?php else: ?>

<p>You may only edit jokes that you posted.</p>
<?php endif; ?>



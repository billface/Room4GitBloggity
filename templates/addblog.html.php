<form action="/blog/add" method="post">
    <input type="hidden" name="blog[id]" value="<?=''?>">
    <label for="blogHeading">Type your blog heading here:</label>
    <textarea id="blogHeading" name="blog[blogHeading]" rows="1" cols="40"></textarea>
    <br>
    <label for="blogText">Type your blog content here:</label>
    <textarea id="blogText" name="blog[blogText]" rows="3" cols="40"></textarea>
    <br>
    <label for="metaDescription">Type your metaDescription here:</label>
    <textarea id="metaDescription" name="blog[metaDescription]" rows="3" cols="40"></textarea>
    <input type="submit" value="Add">
    <br>
</form>
<br>
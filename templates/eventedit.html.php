<?php if (empty($blog->id) || $user->id == $blog->authorId || $user->hasPermission(\Site\Entity\Author::SUPERUSER)) : 

if (isset($_SESSION['uploadErrorMessage'])) {
    echo '<p>You got these errors :'. $_SESSION['uploadErrorMessage']. '</p>';
    unset($_SESSION['uploadErrorMessage']);
}

?>  
<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="event[id]" value="<?=$event->id ?? ''?>">
    <label for="eventHeading">Type your event heading here:</label>
    <textarea id="eventHeading" name="event[eventHeading]" rows="1" cols="40"><?=$event->eventHeading ?? $_SESSION['event']['eventHeading'] ?? ''?></textarea>
    <br>
    <label for="eventText">Type your event here:</label>
    <textarea id="eventText" name="event[eventText]" rows="3" cols="40"><?=$event->eventText ?? $_SESSION['event']['eventText'] ?? ''?></textarea>
    <br>
    
    <label for="eventDate">Event date</label>
    <input type="datetime-local" id="event[eventDate]" name="event[eventDate]" value="<?=$event->eventDate ?? $_SESSION['event']['eventDate'] ?? ''?>">
    <br>
	<?php if (isset ($event->outOfStock) && ($event->outOfStock == 1)) {
        echo 'Sold Out?: <input type="checkbox" checked name="event[outOfStock]" value="1"> ';
    }else{
        echo 'Sold Out?: <input type="checkbox" name="event[outOfStock]" value="1"> ';
    }
    ?>
    <br>

    <label for="eventImageName">Type your image filename here (noSpaces):</label>
    <textarea id="eventImageName" name="event[eventImageName]" class="not-here" rows="1" cols="40"><?=$event->eventImageName ?? $_SESSION['event']['eventImageName'] ?? ''?></textarea>
    <br>
    <label for="eventImage">Image Upload</label>
    <input type="file" name="file">

	<!-- to allow edited upload fail to refill values -->
    <input type="hidden" name="hiddenId" value="<?=$_GET['id'] ?? ''?>">
    <br>

    <br>
    <input type="submit" value="Save">
</form>
<?php else: ?>

<p>You may only edit events that you posted.</p>
<?php endif; ?>
2018-06-07T00:00
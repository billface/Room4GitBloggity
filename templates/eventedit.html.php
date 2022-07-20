<?php if (empty($event->id) ||$userId == $event->authorId): ?>

<form action="" method="post">
	<input type="hidden" name="event[id]" value="<?=$event->id ?? ''?>">
    <label for="eventHeading">Type your event heading here:</label>
    <textarea id="eventHeading" name="event[eventHeading]" rows="1" cols="40"><?=$event->eventHeading ?? ''?></textarea>
    <br>
    <label for="eventText">Type your event here:</label>
    <textarea id="eventText" name="event[eventText]" rows="3" cols="40"><?=$event->eventText ?? ''?></textarea>
    <br>
    
    <label for="eventDate">Event date</label>
    <input type="datetime-local" id="event[eventDate]" name="event[eventDate]" value="<?=$event->eventDate ?? ''?>">
    <br>
	<?php if (isset ($event->outOfStock) && ($event->outOfStock == 1)) {
        echo 'Sold Out?: <input type="checkbox" checked name="event[outOfStock]" value="1"> ';
    }else{
        echo 'Sold Out?: <input type="checkbox" name="event[outOfStock]" value="1"> ';
    }
    ?>
    
    <br>
    <input type="submit" value="Save">
</form>
<?php else: ?>

<p>You may only edit events that you posted.</p>
<?php endif; ?>
2018-06-07T00:00
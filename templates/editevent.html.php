<?php if ($userId == $event['authorId']): ?>

<form action="" method="post">
	<input type="hidden" name="event[id]" value="<?=$event['id']?>">
    <label for="eventHeading">Type your event heading here:</label>
    <textarea id="eventHeading" name="event[eventHeading]" rows="1" cols="40"><?=$event['eventHeading']?></textarea>
    <br>
    <label for="eventText">Type your event here:</label>
    <textarea id="eventText" name="event[eventText]" rows="3" cols="40"><?=$event['eventText']?></textarea>
    <br>
    
    <input type="submit" value="Save">
</form>
<?php else: ?>

<p>You may only edit events that you posted.</p>
<?php endif; ?>
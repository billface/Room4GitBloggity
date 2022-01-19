<form action="/event/add" method="post">
    <input type="hidden" name="event[id]" value="<?=''?>">
    <label for="eventHeading">Type your event heading here:</label>
    <textarea id="eventHeading" name="event[eventHeading]" rows="1" cols="40"></textarea>
    <br>
    <label for="eventText">Type your event content here:</label>
    <textarea id="eventText" name="event[eventText]" rows="3" cols="40">
    </textarea>
    <br>
    <label for="eventDate">event date</label>
    <input type="datetime-local" id="event[eventDate]" name="event[eventDate]">
    <!--<br>
    <label for="eventDate">Event date:</label>
    <input type="datetime-local" id="eventDate"  name="event['eventDate']">
-->
    
    <input type="submit" value="Add">
    <br>
</form>
<br>
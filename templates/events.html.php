<?php //echo '<pre>'; print_r($events); echo '</pre>'; ?>

<?php foreach($events as $event): ?>
<blockquote>
  <h2>
  <!--hidden form field so as not to display id of each event
      form and input tags aren't outside the blockquote to simplify CSS -->
  <?=htmlspecialchars($event->eventHeading, ENT_QUOTES, 'UTF-8')?>

</h2>
    <h3>
    <?php
              $date = new DateTime($event->eventDate);
              echo $date->format('jS F Y H:i');
              ?>
              </h3>
              <p>
    <?=htmlspecialchars($event->eventText, ENT_QUOTES, 'UTF-8')?>
 
</p>

  (by <a href="mailto:<?php
              echo htmlspecialchars($event->getAuthor()->email, ENT_QUOTES, 'UTF-8'); ?>"><?php
              echo htmlspecialchars($event->getAuthor()->name, ENT_QUOTES, 'UTF-8'); ?></a>)

<?php if ($userId == $event->authorId): ?>

  <a href="/event/edit?id=<?=$event->id?>">Edit</a>
  <br>
  <form action="/event/delete" method="post">
    <input type="hidden" name="eventId" value="<?=$event->id?>">
    <input type="submit" value="Delete">
  </form>
  <?php endif; ?>

  </p>
</blockquote>
<?php endforeach; ?>
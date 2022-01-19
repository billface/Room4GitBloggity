<?php //echo '<pre>'; print_r($events); echo '</pre>'; ?>

<?php foreach($events as $event): ?>
<blockquote>
  <h2>
  <!--hidden form field so as not to display id of each event
      form and input tags aren't outside the blockquote to simplify CSS -->
  <?=htmlspecialchars($event['eventHeading'], ENT_QUOTES, 'UTF-8')?>

</h2>
    <h3>
    <?php
              $date = new DateTime($event['eventDate']);
              echo $date->format('jS F Y');
              ?>
              </h3>
              <p>
    <?=htmlspecialchars($event['eventText'], ENT_QUOTES, 'UTF-8')?>
 
</p>

  (by <a href="mailto:<?php
              echo htmlspecialchars($event['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
              echo htmlspecialchars($event['name'], ENT_QUOTES, 'UTF-8'); ?></a>)

  <a href="/event/edit?id=<?=$event['id']?>">Edit</a>
  <br>
  <form action="/event/delete" method="post">
    <input type="hidden" name="eventId" value="<?=$event['id']?>">
    <input type="submit" value="Delete">
  </form>
  </p>
</blockquote>
<?php endforeach; ?>
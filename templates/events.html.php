<?php //echo '<pre>'; print_r($events); echo '</pre>'; ?>

<?php foreach($events as $event): ?>
<blockquote>
  <h2>
  
  <?=(new \Ninja\Markdown($event->eventHeading))->toHtml()?>


</h2>
    <h3>
    <?php
              $date = new DateTime($event->eventDate);
              echo $date->format('jS F Y H:i');
              ?>
              </h3>
              <p>
    <?=(new \Ninja\Markdown($event->eventText))->toHtml()?>

 
</p>

  (by <a href="mailto:<?php

              $author = $event->getAuthor();
              echo htmlspecialchars($author ? $author->email : 'deleted user', ENT_QUOTES, 'UTF-8');
              ?>">
              <?php
              $author = $event->getAuthor();
              echo htmlspecialchars($author ? $author->name : 'deleted user', ENT_QUOTES, 'UTF-8');
               ?></a>)


<?php if ($user): ?>
  <?php if ($user->id == $event->authorId || $user->hasPermission(\Site\Entity\Author::SUPERUSER)): ?>
  <a href="/event/edit?id=<?=$event->id?>">Edit</a>
  <?php endif; ?>

  <br>
  <?php if ($user->id == $event->authorId || $user->hasPermission(\Site\Entity\Author::SUPERUSER)): ?>
    <form action="/event/delete" method="post">
    <input type="hidden" name="eventId" value="<?=$event->id?>">
    <input type="submit" value="Delete">
  </form>
  <?php endif; ?>
  <?php endif; ?>


  </p>
</blockquote>
<?php endforeach; ?>
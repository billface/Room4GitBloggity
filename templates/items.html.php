<?php //echo '<pre>'; print_r($items); echo '</pre>'; die; ?>


<?php foreach($items as $item): ?>
<blockquote>
  <h2>
  <?=htmlspecialchars($item['itemHeading'], ENT_QUOTES, 'UTF-8')?>



</h2>
<?php if ($item['itemPicture'] !== null) 

echo '<p><img src="https://drive.google.com/uc?id='.$item['itemPicture'].'" alt="blah" width="100" height="100"></p>'



//imgur
//echo '<blockquote class="imgur-embed-pub" lang="en" data-id="'.$item->itemPicture.'" data-context="false" ><a href="//imgur.com/a/'. $item->itemPicture. '"></a></blockquote><script async src="//s.imgur.com/min/embed.js" charset="utf-8"></script>'
//echo '<br><blockquote class="imgur-embed-pub" lang="en" data-id="'.$item->itemPicture.'" data-context="false" ><a href="//imgur.com/a/'. $item->itemPicture. '"></a></blockquote><script async src="//s.imgur.com/min/embed.js" charset="utf-8"></script>'

    ?>
              <p>

    <?=htmlspecialchars($item['itemText'], ENT_QUOTES, 'UTF-8')?>


 
</p>

  (by <a href="mailto:<?php

          echo htmlspecialchars($item['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
          echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></a> 
          )
          <h3>
    <?php
              $stock = $item['itemStock'];
              echo 'Stock '.$stock;
              ?>
              </h3>
          <h3>
    <?php
              $price = $item['itemPrice'];
              echo 'Price ' .$price;
              ?>
              </h3>
<h3>
    <?php
              $shipping = $item['itemShipping'];
              echo 'Shipping '. $shipping;
              ?>
              </h3>


              <a href="/item/edit?id=<?=$item['id']?>">Edit</a>
  <br>
  <form action="/item/delete" method="post">
    <input type="hidden" name="itemId" value="<?=$item['id']?>">
    <input type="submit" value="Delete">
  </form>
  </p>
</blockquote>
<?php endforeach; ?>
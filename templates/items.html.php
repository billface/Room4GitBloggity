<?php //echo '<pre>'; print_r($items); echo '</pre>'; die; ?>
<?php //echo '<pre>'; print_r($_SESSION); echo '</pre>'; ?>



<?php foreach($items as $item): ?>
<blockquote>
  <h2>
  <?=htmlspecialchars($item['itemHeading'], ENT_QUOTES, 'UTF-8')?>



</h2>
<?php if ($item['itemPicture'] !== '') {

echo '<p><img src="/uploads/'.$item['itemFileName'].'" alt="'.$item['itemHeading'].'" width="100" height="100"></p>';

}

else {
  echo '<p><img src="/uploads/default.jpg" alt="default" width="100" height="100"></p>';
}



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
              echo 'Price £' .$price;
              ?>
              </h3>
<h3>
    <?php
              $shipping = $item['itemShipping'];
              echo 'Shipping £'. $shipping;
              ?>
              </h3>


              <a href="/item/edit?id=<?=$item['id']?>">Edit</a>
  <br>
  <form action="/item/buy?id=<?=$item['id']?>" method="post">
    <input type="hidden" name="hidden_name" value="<?php echo $item['itemHeading']; ?>">
    <input type="hidden" name="hidden_price" value="<?php echo $item['itemPrice']; ?>">
    Quantity:<input type="number" name="quantity" value="1">
    <input type="submit" name="add" value="Buy">


  </form>

  <form action="/item/delete" method="post">
    <input type="hidden" name="itemId" value="<?=$item['id']?>">
    <input type="submit" value="Delete">
  </form>
  </p>
</blockquote>
<?php endforeach; ?>
<?php if(!empty($_SESSION["cart"])){ ?>

<table >
          <tr>
              <th>Product Name</th>
              <th>Quantity</th>
              <th>Price Details</th>
              <th>Total Price</th>
              <th>Remove Item</th>
          </tr>


                  <?php foreach ($_SESSION["cart"] as $key => $value) { 
                    echo'
                    <tr>
          <td>'.$value["item_name"].'</td>
          <td>'.$value["item_quantity"].'</td>
          <td>$'.$value["product_price"].'</td>
          <td>
              $'.number_format($value["item_quantity"] * $value["product_price"], 2).'</td>
          <td><a href=/item/remove?id='.$value["product_id"].'>Remove Item</a></td>

      </tr>';}
     ?>
     <?php echo
      '<tr>
                <td colspan="3" align="right">Total</td>
                <th align="right">$'.number_format($total, 2).' </th>
                <td></td>
            </tr>' ; ?>
      </table>
<?php } ?>
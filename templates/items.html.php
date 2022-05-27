



<?php foreach($items as $item): ?>
<blockquote>
  <h2>
  <?=htmlspecialchars($item['itemHeading'], ENT_QUOTES, 'UTF-8')?>



</h2>
<?php if (isset($item['itemFileName'])) {

//if ($item['itemPicture'] !== '') {

echo '<p><img src="/uploads/'.$item['itemFileName'].'" alt="'.$item['itemHeading'].'" width="100" height="100"></p>';

}

else {
  echo '<p><img src="/uploads/default.jpg" alt="default" width="100" height="100"></p>';
}




    ?>
              <p>
    
    <?=htmlspecialchars($item['itemPaypalDescription'], ENT_QUOTES, 'UTF-8')?>
    <br>
    <?=htmlspecialchars($item['itemText'], ENT_QUOTES, 'UTF-8')?>
    
    

 
</p>

  (by <a href="mailto:<?php

          echo htmlspecialchars($item['email'], ENT_QUOTES, 'UTF-8'); ?>"><?php
          echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></a> 
          )
  <h3>
    <?php
      if (isset($item['itemStock'])){
        $stock = $item['itemStock'];
        echo 'Stock '.$stock;
      }
    ?>
  </h3>
  <h3>
    <?php
      if (isset($item['itemPrice'])){
        $price = $item['itemPrice'];
        echo 'Price £' .$price;
      }
    ?>
  </h3>
  <h3>
    <?php
      if (isset($item['itemShipping'])){
        $shipping = $item['itemShipping'];
        echo 'Shipping £'. $shipping;
      }
    ?>
              </h3>


              <a href="/item/edit?id=<?=$item['id']?>">Edit</a>
  <br>
  <?php if (isset($item['itemStock'])){ ?>

  <form action="/item/buy?id=<?=$item['id']?>" method="post">
    <input type="hidden" name="hidden_name" value="<?php echo $item['itemHeading']; ?>">
    <input type="hidden" name="hidden_price" value="<?php echo $item['itemPrice']; ?>">
    <input type="hidden" name="hidden_description" value="<?php echo $item['itemPaypalDescription']; ?>">
    
    <select name="size" id="size">
      <option value="small">Small</option>
      <option value="medium">Medium</option>
      <option value="large">Large</option>
      <option value="XL">XL</option>
    </select>
    <br>
    Quantity:<input type="number" name="quantity" value="1">
    <input type="submit" name="add" value="Buy">


  </form>
  <?php } ?>

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
              <th>Item Name</th>
              <th>Quantity</th>
              <th>Price Details</th>
              <th>Total Price</th>
              <th>Remove Item</th>
          </tr>


                  <?php foreach ($_SESSION["cart"] as $key => $value) {
                    echo'
                    <tr>
          <td>'.$value["item_name"].'</td>
          <td>'.$value["item_size"].'</td>
          <td>'.$value["item_quantity"].'</td>
          <td>£'.$value["item_price"].'</td>

          <td>
              £'.number_format($value["item_quantity"] * $value["item_price"], 2).'</td>
          <td><a href=/item/remove?id='.$value["item_id"].'>Remove Item</a></td>

      </tr>';}
     ?>
     <?php echo
      '<tr>
      <td colspan="3" align="right">Postage</td>
                <th align="right">£3.00 </th>
                
      </tr>
      <tr>
                <td colspan="3" align="right">Total</td>
                <th align="right">£'.number_format($total + 3, 2).' </th>
                
            </tr>'
            ; ?>
</table>
      <!-- paypal button will be rendered here using Javascript -->
      <div id="btn-paypal-checkout"></div>
      

<?php } else {?>
 <!-- paypal button will be rendered here using Javascript -->
 <div id="btn-paypal-checkout" style="display:none"></div>
 <?php } ?>

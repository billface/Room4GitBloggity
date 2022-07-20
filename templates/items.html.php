<?php if ($emptyMessage !== null) {
  echo $emptyMessage . '<br><br>';
}

?>


<?php foreach($items as $item): ?>
<blockquote>
  <h2>
  <?=htmlspecialchars($item->itemHeading, ENT_QUOTES, 'UTF-8')?>



</h2>
<?php if (isset($item->itemFileName)) {



echo '<p><img src="/uploads/'.$item->itemFileName.'" alt="'.$item->itemHeading.'" width="100" height="100"></p>';

}

else {
  echo '<p><img src="/uploads/default.jpg" alt="default" width="100" height="100"></p>';
}




    ?>
    <p>
    
    <br>
    <?=$item->itemText?>
    
    

 
</p>

  (by <a href="mailto:<?php

          echo htmlspecialchars($item->getAuthor()->email, ENT_QUOTES, 'UTF-8'); ?>"><?php
          echo htmlspecialchars($item->getAuthor()->name, ENT_QUOTES, 'UTF-8'); ?></a> 
          )
  
  <h3>
    <?php
      if (isset($item->itemPrice)){
        $price = $item->itemPrice;
        echo 'Price £' .$price;
      }
    ?>
  </h3>
  

  <?php if ($userId == $item->authorId): ?>

   <a href="/item/edit?id=<?=$item->id?>">Edit</a>
  <br>
  <?php endif;
  //if there is stock show buy form
  if ($item->outOfStock == 0) {?>

  <form action="/item/buy?id=<?=$item->id?>" method="post">
    <input type="hidden" name="hidden_name" value="<?php echo $item->itemHeading; ?>">
    <input type="hidden" name="hidden_price" value="<?php echo $item->itemPrice; ?>">
   

    
   

<?php if ($item->sizePresent($item->id) != null) { ?>
<select name="size" id="size">

<?php foreach ($itemsizes as $itemsize): ?>

<?php if ($item && $item->hasSize($itemsize->id)): ?>
  <option value="<?=$itemsize->name?>"><?=$itemsize->name?></option>
  

<?php endif; ?>
<?php endforeach; ?>


</select>

<?php } ?>

<br>

<?php if ($item->descPresent($item->id) != null) { ?>
<select name="desc" id="desc">

<?php foreach ($itemdescs as $itemdesc): ?>

<?php if ($item && $item->hasDesc($itemdesc->id)): ?>
  <option value="<?=$itemdesc->name?>"><?=$itemdesc->name?></option>
  

<?php endif; ?>
<?php endforeach; ?>


</select>

<?php } ?>

    

    <br>
    Quantity:<input type="number" name="quantity" value="1">
    <input type="submit" name="add" value="Buy">


  </form>
  <?php } else {?>
    <p>Currently Out Of Stock </p>
  <?php } ?>

  <form action="/item/delete" method="post">
    <input type="hidden" name="itemId" value="<?=$item->id?>">
    <input type="submit" value="Delete">
  </form>
  </p>
</blockquote>
<?php endforeach; ?>
<?php if(!empty($_SESSION["cart"])){ ?>

<table >
          <tr>
              <th>Item Name</th>
              <th>Description</th>
              <th>Size</th>
              <th>Quantity</th>
              <th>Total Price</th>
              <th>Remove Item</th>
          </tr>


                  <?php 
                  foreach ($_SESSION["cart"] as $key => $value) {
            echo'
                    <tr>
          <td>'.$value["item_name"].'</td>
          <td>'.$value["item_desc"].'</td>
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

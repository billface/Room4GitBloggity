<?php 
     //echo '<pre>'; print_r($_SESSION); echo '</pre>';
     


if (empty($item->id) || $userId == $item->authorId): 

if (isset($_SESSION['itemErrorMessage'])) {
    echo '<p>You got these errors :'. $_SESSION['itemErrorMessage']. '</p>';
    unset($_SESSION['itemErrorMessage']);
}

?>


<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="item[id]" value="<?=$item->id ?? ''?>">
    <label for="itemHeading">Type your item heading here:</label>
    <textarea id="itemHeading" name="item[itemHeading]" class="not-here" rows="1" cols="40"><?=$item->itemHeading ?? $_SESSION['item']['itemHeading'] ?? ''?></textarea>
    <br>
    
    <label for="itemText">Type your item content here:</label>
    <textarea id="itemText" name="item[itemText]" rows="3" cols="40"><?=$item->itemText ?? $_SESSION['item']['itemText'] ?? ''?></textarea>
    <br>
    <label for="itemPicture">Type your item picture code here:</label>
    <textarea id="itemPicture" name="item[itemPicture]" class="not-here" rows="1" cols="40"><?=$item->itemPicture ?? $_SESSION['item']['itemPicture'] ?? ''?></textarea>
    <br>
    <!--add sizes -->
    <p>Select sizes for this item:</p>
    <?php
		foreach ($itemsizes as $itemsize) { 
			$doWeHaveASizeMatch = 'no';
					
			if ($item && $item->hasSize($itemsize->id)){
				echo '<input type="checkbox" checked name="itemsize[]" value="'.$itemsize->id.'" />';
					 
			} else if (isset($_SESSION['itemsize'])) {
				foreach ($_SESSION['itemsize'] as $itemSizeSelected) {
					if ($itemSizeSelected == $itemsize->id) {
						$doWeHaveASizeMatch = 'yes';
					}
				}
				if ($doWeHaveASizeMatch == 'yes') {
					echo '<input type="checkbox" checked name="itemsize[]" value="'.$itemsize->id.'" />'; 
				} else {
					echo '<input type="checkbox" name="itemsize[]" value="'.$itemsize->id.'" />'; 
				}
			} else {
				echo '<input type="checkbox" name="itemsize[]" value="'.$itemsize->id.'" />'; 
			}

			echo '<label>'.$itemsize->name.'</label>';
		}
		?>
    <br>
    <a href="/itemsize/edit">Add a new size</a>
    <br>
    <!--add description -->

    <p>Select description for this item:</p>
    <?php
		foreach ($itemdescs as $itemdesc) { 
			$doWeHaveADescMatch = 'no';
					
			if ($item && $item->hasDesc($itemdesc->id)){
				echo '<input type="checkbox" checked name="itemdesc[]" value="'.$itemdesc->id.'" />';
					 
			} else if (isset($_SESSION['itemdesc'])) {
				foreach ($_SESSION['itemdesc'] as $itemDescSelected) {
					if ($itemDescSelected == $itemdesc->id) {
						$doWeHaveADescMatch = 'yes';
					}
				}
				if ($doWeHaveADescMatch == 'yes') {
					echo '<input type="checkbox" checked name="itemdesc[]" value="'.$itemdesc->id.'" />'; 
				} else {
					echo '<input type="checkbox" name="itemdesc[]" value="'.$itemdesc->id.'" />'; 
				}
			} else {
				echo '<input type="checkbox" name="itemdesc[]" value="'.$itemdesc->id.'" />'; 
			}

			echo '<label>'.$itemdesc->name.'</label>';
		}
		?>
    <br>
    <a href="/itemdesc/edit">Add a new description</a>
    <br>

    
    <label for="itemPrice">Price</label>
    <input type="number" id="item[itemPrice]" name="item[itemPrice]" value="<?=$item->itemPrice ?? $_SESSION['item']['itemPrice'] ?? ''?>">
    <br>
    Out Of Stock?: <input type="checkbox" name="item[outOfStock]" value="1">
    <br>
    
    <label for="itemImage">Image Upload</label>
    <input type="file" name="file">
    <input type="hidden" name="hiddenId" value="<?=$_GET['id'] ?? ''?>">
    <br>
    <input type="submit" value="Save">

</form>
<?php unset($_SESSION['item']); ?>
<?php else: ?>

<p>You may only edit events that you posted.</p>
<?php endif; ?>

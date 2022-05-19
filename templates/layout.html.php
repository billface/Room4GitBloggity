<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="blogs.css">
    <title><?=$title?></title>
  </head>
  <body>
  <nav>
    <header>
      <h1>Internet Blog Database</h1>
    </header>
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="/site/about">About</a></li>
      <li><a href="/blog/list">Blog List</a></li>
      <li><a href="/event/list">Calendar</a></li>
      <li><a href="/item/list">Shop</a></li>
      <li><a href="/blog/addpage">Add a new blog</a></li>
      <li><a href="/event/addpage">Add a new event</a></li>
      <li><a href="/item/addpage">Add a new item</a></li>
      <?php if ($loggedIn): ?>
			<li><a href="/logout">Log out</a></li>
			<?php else: ?>
			<li><a href="/login">Log in</a></li>
			<?php endif; ?>
    </ul>
  </nav>

  <main>
  <?=$output?>
  </main>
    <p>
  <span id="insertHere"></span>
            Sausages
    </p>

    <?php echo '<pre>'; print_r($_SESSION["cart"]); echo '</pre>'; 
    $age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);
    echo json_encode($age);

    ?> 


  <footer>
  &copy; Bodged Websites 2020&ndash;<?php echo date('Y'); ?>
  </footer>
 <?=$script;?>
 <script>
   //IT'D BE NICE TO POPULATE THIS ARRAY WITH THE SESSION DATA
   
   /*var cart = <?php echo json_encode($_SESSION["cart"]); ?>;
   var ageD = <?php echo json_encode($age); ?>;
   document.getElementById('insertHere').innerHTML = (ageD);
   console.log(ageD);
   console.log(cart)*/


    window.addEventListener("load", function () {
        var cartItems = [{
            name: "Total",
            description: "Description of product 1",
            quantity: 1,
            price: <?=$_SESSION["checkoutTotal"];?>,
            sku: "prod1",
            currency: "USD"
        }/*, {
            name: "Product 2",
            description: "Description of product 2",
            quantity: 3,
            price: 20,
            sku: "prod2",
            currency: "USD"
        }, {
            name: "Product 3",
            description: "Description of product 3",
            quantity: 4,
            price: 10,
            sku: "prod3",
            currency: "USD"
        }*/];

        var total = 0;
        for (var a = 0; a < cartItems.length; a++) {
            total += (cartItems[a].price * cartItems[a].quantity);
        

        // Render the PayPal button
        paypal.Button.render({

            // Set your environment
            env: 'sandbox', // sandbox | production
 
            // Specify the style of the button
            style: {
                label: 'checkout',
                size: 'medium', // small | medium | large | responsive
                shape: 'pill', // pill | rect
                color: 'gold', // gold | blue | silver | black,
                layout: 'vertical'
            },

            // PayPal Client IDs - replace with your own
            // Create a PayPal app: https://developer.paypal.com/developer/applications/create

            client: {
                sandbox: 'AbPlQy4uC6FTFnjlST33seQdjHXX0UQEWvnJ-Nskgo6gtja4altpSXSVRMHJXS_jY0wGXu5U_Njw17qH',
                production: 'AfwN7TBcRZpDz3147cEC1u6bKXgAR5wpMD3jYg8A3zclMH9xK205qzS_mKngt1qnuO9aIkx40_kOXMfd'
            },

            funding: {
                allowed: [
                    paypal.FUNDING.CARD,
                    paypal.FUNDING.ELV
                ]
            },

            payment: function(data, actions) {
                return actions.payment.create({
                    payment: {
                        transactions: [{
                            amount: {
                                total: total,
                                currency: 'USD'
                            },
                            item_list: {
                                // custom cartItems array created specifically for PayPal
                                items: cartItems
                            }
                        }]
                    }
                });
            },

            onAuthorize: function(data, actions) {
                return actions.payment.execute().then(function() {
                    // you can use all the values received from PayPal as you want
                    console.log({
                        "intent": data.intent,
                        "orderID": data.orderID,
                        "payerID": data.payerID,
                        "paymentID": data.paymentID,
                        "paymentToken": data.paymentToken
                    });

                    // [call AJAX here]
                    paymentMade(data.orderID, data.payerID, data.paymentID, data.paymentToken);
                    //window.location = "/item/success";

                    
                });
            },

            onCancel: function (data, actions) {
                console.log(data);
                //window.location = "/item/failure";

            }
 
        }, '#btn-paypal-checkout');
    });

    function paymentMade(orderID, payerID, paymentID, paymentToken) {
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "../../paypal.php", true);
 
    ajax.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                console.log(response);
            }
 
            if (this.status == 500) {
                console.log(this.responseText)
                //window.location.replace(url:"http://bbc.co.uk");
            }
        }
    };
 
    var formData = new FormData();
    formData.append("orderID", orderID);
    formData.append("payerID", payerID);
    formData.append("paymentID", paymentID);
    formData.append("paymentToken", paymentToken);
    ajax.send(formData);

    

}
</script>

            
<!-- Load the required checkout.js script -->
<script src="https://www.paypalobjects.com/api/checkout.js" data-version-4></script>
 
<!-- Load the required Braintree components. -->
<script src="https://js.braintreegateway.com/web/3.39.0/js/client.min.js"></script>
<script src="https://js.braintreegateway.com/web/3.39.0/js/paypal-checkout.min.js"></script>

 <br>
  </body>
</html>
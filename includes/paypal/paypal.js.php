<script>
    window.addEventListener("load", function () {
        var cartItems = [
            
            //Populating Paypal Javascript array with $_SESSION DATA
            <?php
            $paypalArray = array();
            foreach($_SESSION["cart"] as $paypalCart){
                $paypalArray[] = '{
            name: "'.$paypalCart['item_name'].'",
            description: "'.$paypalCart['item_name'].'",
            quantity: '.$paypalCart['item_quantity'].',
            price: '.$paypalCart['item_price'].',
            sku: "'.$paypalCart['item_id'].'",
            currency: "GBP"
                }';
            }
            echo implode(',', $paypalArray);

            ?>
            ,{
                name: "Postage",
            description: "Postage",
            quantity: 1,
            price: 3,
            sku: "1",
            currency: "GBP"   
            }];

        var total = 0;
        for (var a = 0; a < cartItems.length; a++) {
            total += (cartItems[a].price * cartItems[a].quantity);
        
        }
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
                                currency: 'GBP'
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
                    window.location = "/item/success";

                    
                });
            },

            onCancel: function (data, actions) {
                console.log(data);
                window.location = "/item/failure";

            }
 
        }, '#btn-paypal-checkout');
    });

    function paymentMade(orderID, payerID, paymentID, paymentToken) {
    var ajax = new XMLHttpRequest();
    ajax.open("POST", "../../paypal.php", true);
    
    //checking connection
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
    
    //posting formData
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
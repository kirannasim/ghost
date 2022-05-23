'use strict';

var stripeKey = 'pk_test_51JRk8NDVZh2Lq3ZogcoKAvg8G9jLOqUPY1xKWxq9wX1arpW102ru0ezBvA52CkFjBpxK4pZGEn8wbjP3QGIzk1Ue000Lidpbvr';
var stripe = Stripe(stripeKey);

$(function() {
    $(document).ready(function() {
        if ( $('#card-number').length == 0 )        
            return;
            
        var elements = stripe.elements();

        var elementStyles = {
            base: {
                color: "#ffffff",
                fontFamily: 'Arial, sans-serif',
                fontSmoothing: "antialiased",
                fontSize: "16px"
            },
            invalid: {
                fontFamily: 'Arial, sans-serif',
                color: "#fa755a",
                iconColor: "#fa755a"
            }
        };

        var elementClasses = {
            focus: 'focused',
            empty: 'empty',
            invalid: 'invalid',
        };

        var cardNumber = elements.create('cardNumber', {
            style: elementStyles,
            classes: elementClasses,
        });
        cardNumber.mount('#card-number');

        var cardExpiry = elements.create('cardExpiry', {
            style: elementStyles,
            classes: elementClasses,
        });
        cardExpiry.mount('#card-expiry');        

        var cardCvc = elements.create('cardCvc', {
            style: elementStyles,
            classes: elementClasses,
        });
        cardCvc.mount('#card-cvv');

        var savedErrors = {};
        var elements = [cardNumber, cardExpiry, cardCvc];
        elements.forEach(function(element, idx) {
            element.on('change', function(event) {
                if (event.error) {
                    savedErrors[idx] = event.error.message;
                    showError(event.error.message);
                    loading(true);
                } else {
                    savedErrors[idx] = null;

                    // Loop over the saved errors and find the first one, if any.
                    var nextError = Object.keys(savedErrors)
                        .sort()
                        .reduce(function(maybeFoundError, key) {
                            return maybeFoundError || savedErrors[key];
                        }, null);

                    if (nextError) {
                        // Now that they've fixed the current error, show another one.
                        showError(nextError);
                        loading(true);
                    } else {
                        // The user fixed the last error; no more errors.
                        showError('');
                        loading(false);
                    }
                }
            });
        });

        $('.page-checkout .buy').click(function(e) {
            if ($(this).attr('disabled')) 
                return;

            var form = $('#form-card');

            if (!form.hasClass('active'))
                return;
    
            confirmOrder();
        });
        
        function confirmOrder() {
            var price = parseFloat($('#form-card').find('[name="prod"]').val());
            var purchase = {
                user_id: $('#form-card').find('[name="user_id"]').val(),
                email: $('#form-card').find('[name="user_email"]').val(),
                price: price,
                name: $('#form-card').find('[name="name"]').val()
            };
    
            loading(true);
    
            $.ajax({
                url: "/payments/stripe/create-order.php",
                method: "POST",
                data: JSON.stringify(purchase),
                dataType: 'json',
                contentType : 'application/json'
            }).done(function(result) {
                stripe.confirmCardPayment(result.clientSecret, {
                    payment_method: {
                        card: cardNumber,
                        billing_details: {
                            name: $('#form-card').find('[name="name"]').val(),
                        },                    
                    }
                }).then(function(res) {
                    loading(false);
    
                    if (res.error) {
                        showError(res.error.message);
                    } else {
                        // The payment succeeded!                        
                        window.location.href = '/payments/stripe/success.php?orderId=' + result.orderHash + '&amount=' + price;
                    }
                });
            });            
        }
    
        // Show the customer the error from Stripe if their card fails to charge
        function showError(msg) {
            $('.error .message').html(msg);
            setTimeout(function() {
                $('.error .message').html('');
            }, 10000);
        };
        
        // Show a spinner on payment submission
        function loading(isLoading) {
            $('.page-checkout .buy').attr('disabled', isLoading);
        };      
    });
});
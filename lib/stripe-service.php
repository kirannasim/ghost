<?php

require_once __DIR__ . '/../vendor/stripe/stripe-php/init.php';

use Stripe\Stripe;
use Stripe\WebhookEndpoint;
use Stripe\PaymentIntent;

class StripeService {
  
    private $apiKey = 'sk_test_51L0z4QCSRP72dCpbSr8P6IVCB6rxvW2vORucZNAYK59i5szN1MXyY1qgRdLfiFQgrbGgrxhaDMxijr6aABXI0eda00aiN5Fri5';
    private $publishableKey = 'pk_test_51L0z4QCSRP72dCpbjqqIHyFtL6mczU1A6aIgUDwIpnDuvxAQ9uSXK8rhFWirXNX6PovZQXm1Qst4X0DljcfzMUkx006kIo6UPC';
    
    private $stripeService;

    public function __construct() {
        $this->stripeService = new \Stripe\StripeClient(  $this->apiKey );        
    }

    public function getPublishableKey() {
        return $this->publishableKey;
    }

    public function createCheckoutSession( $success_url, $cancel_url ) {
        $this->stripeService->checkout->sessions->create([
            'success_url' => $success_url,
            'cancel_url' => $cancel_url,
            'line_items' => [[
                'price_data' => [
                    # The currency parameter determines which
                    # payment methods are used in the Checkout Session.
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Credit',
                    ],
                    'unit_amount' => 50,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'payment_method_types' => ['card'],
        ]);
    }

    // public function createPaymentIntent( $orderReferenceId, $amount, $currency, $email, $customerDetailsArray, $notes, $metaData ) {
    //     try {


    //         $paymentIntent = PaymentIntent::create([
    //             'description' => $notes,
    //             'shipping' => [
    //                 'name' => $customerDetailsArray["name"],
    //                 'address' => [
    //                     'line1' => $customerDetailsArray["address"],
    //                     'postal_code' => $customerDetailsArray["postalCode"],
    //                     'country' => $customerDetailsArray["country"]
    //                 ]
    //             ],
    //             'amount' => $amount * 100,
    //             'currency' => $currency,
    //             'payment_method_types' => [
    //             'card'
    //             ],
    //             'metadata' => $metaData
    //         ]);

    //         $output = array(
    //             "status" => "success",
    //             "response" => array('orderHash' => $orderReferenceId, 'clientSecret'=>$paymentIntent->client_secret)
    //         );
    //     } catch (\Error $e) {
    //         $output = array(
    //             "status" => "error",
    //             "response" => $e->getMessage()
    //         );
    //     }

    //     return $output;
    // }
}
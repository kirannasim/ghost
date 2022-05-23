<?php
require_once __DIR__ . '/../config.php';

use Stripe\Stripe;
use Stripe\WebhookEndpoint;
use Stripe\PaymentIntent;

require_once __DIR__ . '/../vendor/autoload.php';

class StripeService {
  
    private $stripeService;

    public function __construct() {
        $this->stripeService = new Stripe();
        $this->stripeService->setVerifySslCerts(false);
        $this->stripeService->setApiKey( Config::STRIPE_CONFIG['api_key'] );
    }

    public function getPublishableKey() {
        return Config::STRIPE_CONFIG['public_key'];
    }

    public function createPaymentIntent( $orderReferenceId, $amount, $metaData ) {
        try {
            $this->stripeService->setApiKey( Config::STRIPE_CONFIG['api_key'] );

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $amount * 100,
                'currency' => 'usd',
                'payment_method_types' => [
                    'card'
                ],
                'metadata' => $metaData
            ]);
            $output = array(
                "status" => "success",
                "response" => array('orderHash' => $orderReferenceId, 'clientSecret'=>$paymentIntent->client_secret)
            );
        } catch (\Error $e) {
            $output = array(
                "status" => "error",
                "response" => $e->getMessage()
            );
        }
        return $output;
    }

    public function getToken() {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet) - 1;
        for ($i = 0; $i < 17; $i ++) {
            $token .= $codeAlphabet[mt_rand(0, $max)];
        }
        return $token;
    }
}
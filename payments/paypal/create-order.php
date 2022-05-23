<?php
require_once __DIR__ . '/../../config.php';

$paypalUrl = Config::PAYPAL_CONFIG['enableSandbox'] ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// Include Functions
//require 'functions.php';

// Check if paypal request or response
if ( ! isset( $_POST["txn_id"] ) && ! isset( $_POST["txn_type"] ) ) {

    // Grab the post data so that we can set up the query string for PayPal.
    // Ideally we'd use a whitelist here to check nothing is being injected into
    // our post data.
    $data = [];

    foreach ($_POST as $key => $value) {
        $data[$key] = stripslashes($value);
    }

    // Set the PayPal account.
    $data['business'] = Config::PAYPAL_CONFIG['email'];

    // Set the PayPal return addresses.
    $data['return'] = stripslashes( Config::PAYPAL_CONFIG['return_url'] );
    $data['cancel_return'] = stripslashes( Config::PAYPAL_CONFIG['cancel_url'] );
    $data['notify_url'] = stripslashes( Config::PAYPAL_CONFIG['notify_url'] );

    // Set the details about the product being purchased, including the amount
    // and currency so that these aren't overridden by the form data.
    $data['item_name'] = 'Credit';
    $data['amount'] = $_POST['prod'];
    $data['currency_code'] = 'USD';

    $data['return'] .= '?amount=' . $data['amount'];
    $data['cancel_return'] .= '?amount=' . $data['amount'];
    $data['notify_url'] .= '?amount=' . $data['amount'];

    // Add any custom fields for the query string.
    //$data['custom'] = USERID;

    // Build the query string from the data.
    $queryString = http_build_query( $data );

    // Redirect to paypal IPN
    header('location:' . $paypalUrl . '?' . $queryString);
    exit();

} else {
    // Handle the PayPal response.
}

?>
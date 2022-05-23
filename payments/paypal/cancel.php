<?php
session_start();

if ( ! empty ( $_GET['amount'] ) ) {
    require_once __DIR__ . '/../../lib/Payment.php';

    $payment = new Payment();
    
    $payerId = $_GET['PayerID'];
    $amount = $_GET['amount'];
    $user = $_SESSION['user'];
    $order_hash = $payment->generateHash( $payerId );
    
    $payment->insertOrder( $user['user_id'], $user['user_email'], 'paypal', '', $amount, 'usd', 'Canceled', '', $user['user_email'] );

    header('Location: /account');
    exit;
}
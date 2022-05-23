<?php
if ( ! empty( $_GET['orderId'] ) && ( ! empty ( $_GET['amount'] ) ) ) {
    $orderId = $_GET['orderId'];
    $amount = $_GET['amount'];

    require_once __DIR__ . '/../../lib/Payment.php';

    $payment = new Payment();
    $payment->updateOrder( $orderId, 'Completed' );
    
    if ( $payment->updateUserCredit( $orderId, $amount ) ) {
        header('Location: /account');
        exit;
    }
}
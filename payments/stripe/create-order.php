<?php
$content = trim(file_get_contents("php://input"));
$jsondecoded = json_decode($content, true);

if (! empty($jsondecoded)) {
    require_once __DIR__ . "/../../lib/StripeService.php";
    require_once __DIR__ . '/../../lib/Payment.php';    

    $stripeService = new StripeService();
    $payment = new Payment();
    
    $user_id = filter_var($jsondecoded["user_id"], FILTER_SANITIZE_STRING);
    $email = filter_var($jsondecoded["email"], FILTER_SANITIZE_EMAIL);
    $name = filter_var($jsondecoded["name"], FILTER_SANITIZE_STRING);
    $orderReferenceId = $stripeService->getToken();
    $unitPrice = $jsondecoded["price"];
    $orderStatus = "Pending";
    $metaData = array(
        "name" => $name,
        "email" => $email,
        "order_id" => $orderReferenceId
    );
    $notes = '';
    
    $orderId = $payment->insertOrder($user_id, $email, 'stripe', $orderReferenceId, $unitPrice, 'usd', $orderStatus, $notes, $name);
    $result = $stripeService->createPaymentIntent($orderReferenceId, $unitPrice, $metaData);

    if (! empty($result) && $result["status"] == "error") {
        http_response_code(500);
    }

    echo json_encode($result["response"]);
    exit();
}
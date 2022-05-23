<?php
require_once __DIR__ . "/../db.php";

class Payment {
    private $db;

    function __construct() {        
        $this->ds = new Database();
    }

    public function insertOrder( $user_id, $user_email, $paymentType, $orderReferenceId, $unitAmount, $currency, $orderStatus, $notes, $name ) {
        $order_date = date( "Y-m-d H:i:s" );
        $query = "INSERT INTO tbl_payments(user_id, user_email, payment_type, order_hash, amount, currency, order_date, order_status, notes, name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";

        $paramValue = array(
            $user_id,
            $user_email,
            $paymentType,
            $orderReferenceId,
            $unitAmount,
            $currency,
            $order_date,
            $orderStatus,
            $notes,
            $name
        );

        $paramType = "isssdsssss";
        $insertId = $this->ds->execute( $query, $paramType, $paramValue );
        return $insertId;
    }

    public function updateOrder( $orderId, $orderStatus ) {
        $query = "UPDATE tbl_payments SET order_status = ? WHERE order_hash = ?";

        $paramValue = array(
            $orderStatus,
            $orderId
        );

        $paramType = "ss";
        $this->ds->execute( $query, $paramType, $paramValue );
    }

    public function updateUserCredit( $orderId, $amount ) {
        $query = "SELECT * FROM tbl_users WHERE user_id = (SELECT user_id FROM tbl_payments WHERE order_hash = ? LIMIT 1)";

        $paramValue = array(
            $orderId
        );

        $paramType = "s";
        $user = $this->ds->select( $query, $paramType, $paramValue );        

        if ( ! empty( $user ) ) {
            $user = $user[0];
            $user_id = $user['user_id'];
            $credit = $user['user_credit'] + $amount;

            $query = "UPDATE tbl_users SET user_credit = ? where user_id = ?";

            $paramValue = array(
                $credit,
                $user_id
            );

            $paramType = "ds";
            $this->ds->execute( $query, $paramType, $paramValue );

            return true;
        }

        return false;
    }

    public function generateHash( $payerId ) {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet) - 1;
        for ($i = 0; $i < 17; $i ++) {
            $token .= $codeAlphabet[mt_rand(0, $max)];
        }
        return $payerId . '_' . $token;
    }
}
?>
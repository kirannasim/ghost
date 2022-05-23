<?php
class Config {
    const DOMAIN_URL    = 'http://domain.com';

    const PAYPAL_CONFIG = array(
        'email'         => 'sb-tdyt416588660@business.example.com',
        'return_url'    => Config::DOMAIN_URL . '/payments/paypal/success.php',
        'cancel_url'    => Config::DOMAIN_URL . '/payments/paypal/cancel.php',
        'notify_url'    => Config::DOMAIN_URL . '/payments/paypal/notify.php',
        'enableSandbox' => true
    );

    const STRIPE_CONFIG = array(
        'api_key'       => 'sk_test_51JRk8NDVZh2Lq3ZoaakDDbVic9C4E2mWOhhsPWiHKe3CtW44BYSxtJUtVFxvgzAGd0qTLp8FS96XeP7kxXFlNtZs00dCleGkpj',
        'public_Key'    => 'pk_test_51JRk8NDVZh2Lq3ZogcoKAvg8G9jLOqUPY1xKWxq9wX1arpW102ru0ezBvA52CkFjBpxK4pZGEn8wbjP3QGIzk1Ue000Lidpbvr'
    );

    const DB            = array(
        'host'          => 'localhost',
        'user'          => 'root',
        'pass'          => '',
        'db_name'       => 'ghost'
    );

    const COOKIE_EXPIRE_DAYS = 30;
}
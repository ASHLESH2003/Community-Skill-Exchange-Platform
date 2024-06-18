<?php

require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51PIgotSHeJqFjESJdQR84r0CWvZRG3yZduAsrSlcXVlmHMPWsxuvSm7cfz6YofdLvuul88qBg56Qm7M8GUWhKORq00LuJcStxM";

\Stripe\Stripe::setApiKey($stripe_secret_key);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/FINAL%20YEAR%20PROJECT/FINAL-YEAR-PROJECT/paymentsuccess.php?email=" . $_GET['email'],
    "cancel_url" => "http://localhost/index.php",
    "locale" => "auto",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "USD",
                "unit_amount" => $_GET['price'],
                "product_data" => [
                    "name" => "Service"
                ]
            ]
        ]
    ]
]);


http_response_code(303);
header("Location: " . $checkout_session->url);
?>
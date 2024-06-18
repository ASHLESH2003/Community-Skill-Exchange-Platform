<?php
    require_once "stripe-php-master/init.php";

    $stripeDetails = array(
        "secretKey" => "Your Secret test Key",
        "publishableKey" => "Your Publishable Key"
    );

    \Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);
?>
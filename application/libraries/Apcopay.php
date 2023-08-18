<?php 

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/ApcoPayGateway.php';
require __DIR__ . '/src/Configuration.php';
require __DIR__ . '/src/TransactionType.php';
require __DIR__ . '/src/TransactionRequest.php';
require __DIR__ . '/src/TransactionResponse.php';
require __DIR__ . '/src/NotificationRequest.php';
require __DIR__ . '/src/RedirectRequest.php';
require __DIR__ . '/vendor/autoload.php';


$gateway = new ApcoPay\ApcoPayGateway(
    new ApcoPay\Configuration(
        "4945",
        "kO7vNYpSjVWH8",
        "b74b9dc161",
        "https://merchanturl.com/apcopay/notification",
        "https://merchanturl.com/apcopay/redirect"
    )
);


$transactionRequest = new ApcoPay\TransactionRequest();
$transactionRequest->amount = "2.40";
$transactionRequest->currency_code = "978";
$transactionRequest->order_reference = "1234";
$transactionRequest->transaction_type = ApcoPay\TransactionType::Purchase;
$transactionRequest->user_defined_function ="CT=TESTCARD";
$transactionRequest->card_number = "4444444444444444";
$transactionRequest->card_cvv = "123";
//$transactionRequest->card_number = "4111111111111111";
//$transactionRequest->card_cvv = "111";
$transactionRequest->card_holder = "John Doe";
$transactionRequest->card_expiry_month = "12";
$transactionRequest->card_expiry_year = "21";

$transactionResponse = $gateway->processTransaction($transactionRequest);
echo "<pre>";
print_r($transactionResponse);
if ($transactionResponse->result === "CAPTURED" || $transactionResponse->result === "APPROVED" || $transactionResponse->result === "VOIDED") {
    echo "Successfull";
} else if ($transactionResponse->result == 'ENROLLED') {
	echo "ENROLLED";
    $redirectUrl = "https://www.apsp.biz/pay/3DSFP2/verify.aspx?id=" . $transactionResponse->psp_id;
    // Redirect to $redirectUrl
} else {
   echo "Failed";
}

?>
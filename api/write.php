<?php

// Allow any site to fetch this result.
header("Access-Control-Allow-Origin: *");

// Set header to let browser know to expect json instead of html.
header("Content-Type: application/json; charset=UTF-8");

// Setup POST to be the only acceptable way to contact this page.
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Transaction class.
include_once('classes/database.php');

include_once 'classes/transaction.php';
$db = new DataBase();

$transactions_object = new Transaction($db);


// Get the posted data.
$transaction_data = json_decode(file_get_contents('php://input'));
//echo $transaction_data;
var_dump($transaction_data);

// Setup response structure.
$response = [
    'results' => null
];

//trigger exception in a "try" block
try {
    // Try to create transaction.
    $transactions_object->insertData($transaction_data);

    // Set a suitable response code.
    http_response_code(201);

    // Set a readable message.
    $response['info']['message'] = "Transaction created!";

    // Add the newly created transaction to results.
    $response['results'] = $transaction_data;
}

//catch exception
catch (Exception $e) {
    // Set a suitable response code.
    http_response_code(500);
    echo $e->getMessage();
    // Set a readable message.
    $response['info']['message'] = "Couldn't create transaction!" . $e;
};

// Format response.
// Same as last one.
echo json_encode($response);

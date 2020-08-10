<?php

// Allow any site to fetch this result.
header("Access-Control-Allow-Origin: *");

// Set header to let browser know to expect json instead of html.
header("Content-Type: application/json; charset=UTF-8");

include_once('classes/database.php');
include_once 'classes/recipient.php';
$db = new DataBase();

$recipient_object = new Recipients($db);

// Get recipient
$recipient = $recipient_object->recipientData();

/* Setup response structure. */
$response = [
    'info' => [
        'posts' => count($recipient),
    ],
    'result' => $recipient
];

// Different response depending on if we get any recipients or not.
if ($recipient) {
    // Set a suitable http response code. 
    http_response_code(200);

    // Set a message in the info property to announce that everything went ok.
    $response['info']['message'] = 'Everything was ok';
} else {
    // Set a suitable http response code.
    http_response_code(404);

    // Set a message in the info property to give a readable status to the user.
    $response['info']['message'] = "Couldn't find any records";
}

// In order to send back json data, print the data in json format.
echo json_encode($response);

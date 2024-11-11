<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set the response headers to ensure proper JSON output and CORS handling
header("HTTP/1.1 200 OK");
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Pragma: no-cache");

// Simulate some data to send back in the API response
$data = [
    "message" => "This is a sample response from the server.",
    "timestamp" => time(),  // Returns the current Unix timestamp
    "status" => "success"   // A simple status field for easier response handling
];

// Encode the data array into a JSON format and output it
echo json_encode($data);
?>
<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the file path to delete from the POST request
    $fileToDelete = isset($_POST['file']) ? $_POST['file'] : '';

    // Check if the file path is provided and if the file exists
    if (!empty($fileToDelete) && file_exists($fileToDelete)) {
        // Try to delete the file
        if (unlink($fileToDelete)) {
            echo json_encode(["message" => "File deleted successfully."]);
        } else {
            echo json_encode(["message" => "An error occurred while deleting the file."]);
        }
    } else {
        // If file is not found or path is not provided, return error message
        echo json_encode(["message" => "File not found or parameter not provided."]);
    }
} else {
    // If the request method is not POST, return an error message
    echo json_encode(["message" => "Invalid request method."]);
}
?>
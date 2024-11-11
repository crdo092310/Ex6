<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDirectory = "uploads/";
    $targetFile = $targetDirectory . basename($_FILES["file"]["name"]);
    $uploadOk = 1;

    // Create uploads directory if it doesn't exist
    if (!file_exists($targetDirectory)) {
        mkdir($targetDirectory, 0777, true);
    }

    // Check if file is an actual image or a fake image
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check === false) {
        echo json_encode(["message" => "File is not an image."]);
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo json_encode(["message" => "Sorry, file already exists."]);
        $uploadOk = 0;
    }

    // Check file size (limit to 500KB)
    if ($_FILES["file"]["size"] > 500000) {
        echo json_encode(["message" => "Sorry, your file is too large."]);
        $uploadOk = 0;
    }

    // Allow certain file formats
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo json_encode(["message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed."]);
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo json_encode(["message" => "Sorry, your file was not uploaded."]);
    } else {
        // Try to move the uploaded file
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
            echo json_encode(["message" => "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded."]);
        } else {
            echo json_encode(["message" => "Sorry, there was an error uploading your file."]);
        }
    }
} else {
    echo json_encode(["message" => "Invalid request method."]);
}
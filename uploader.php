<?php
function uploadFiles($files) {
    // allowed image types:
    $allowedTypes = ['image/jpeg', 'image/png'];
    // Max image size:
    $maxFileSize = 3 * 1024 * 1024;
    if ($files['files']['name'][0] == "") {
        return "Please select one or more images to upload";
    }
    $folder = "images/";
    $names = $files['files']['name'];
    $tmpNames = $files['files']['tmp_name'];
    $types = $files['files']['type'];
    $sizes = $files['files']['size'];

    // combine tmp_name, name, type, and size arrays into one:
    $filesArray = array_map(null, $tmpNames, $names, $types, $sizes);
    foreach ($filesArray as $fileData) {
        list($tmpFolder, $imageName, $fileType, $fileSize) = $fileData;
        // check file type:
        if (!in_array($fileType, $allowedTypes)) {
            return "Error: Only .jpg, .jpeg, and .png files are allowed. File: " . $imageName;
        }
        // check file size:
        if ($fileSize > $maxFileSize) {
            return "Error: File " . $imageName . " exceeds the maximum size of 3MB.";
        }
        // move if validation passed:
        if (!move_uploaded_file($tmpFolder, $folder . $imageName)) {
            return "Error uploading file: " . $imageName;
        }
    }
    return "success";
}

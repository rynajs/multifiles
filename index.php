<?php
require "uploader.php";
$result = "";
if (isset($_FILES["files"])) {
    $result = uploadFiles($_FILES);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Files Upload</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<form action="index.php" method="POST" enctype="multipart/form-data">
    <label for="photo">Upload Your Images:</label>
    <p>Allowed image types: jpg, png. Maximum file size: 4MB</p>
    <input type="file" name="files[]" id="photo" multiple required>
    <button type="submit" name="upload">Upload Files</button>

    <?php if ($result == "success") { ?>
        <p class="success">Images uploaded successfully!</p>
    <?php } elseif ($result != "") { ?>
        <p class="error"><?= $result; ?></p>
    <?php } ?>
</form>
</body>
</html>
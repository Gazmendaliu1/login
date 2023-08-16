<?php
function fileUpload($picture) {
   
    $imageDirectory = "pictures/";

    if ($picture["error"] == 4) {
        // No picture has been chosen, keep the default image
        $pictureName = "avatar.png";
        $message = "No picture has been chosen, but you can upload an image later :)";
    } else {
        // Check if the uploaded file is an image
        $checkIfImage = getimagesize($picture["tmp_name"]);
        $message = $checkIfImage ? "Ok" : "Not an image";
    }

    if ($message == "Ok") {
        // Delete the old image 
        if (isset($picture["old_picture"]) && file_exists($imageDirectory . $picture["old_picture"])) {
            unlink($imageDirectory . $picture["old_picture"]);
        }

        
        $ext = strtolower(pathinfo($picture["name"], PATHINFO_EXTENSION));
        $pictureName = uniqid("") . "." . $ext;

        // destination path for the new imgg
        $destination = $imageDirectory . $pictureName;

        // Move the uploaded file to the destination
        move_uploaded_file($picture["tmp_name"], $destination);
    }

    return [$pictureName, $message];
}
?>

<?php
include 'conn.php';

function uploadImage($file, $upload_dir) {
    $target_file = $upload_dir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is an actual image or fake image
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        die("File is not an image.");
    }

    // Check file size
    if ($file["size"] > 5000000) {
        die("Sorry, your file is too large.");
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }

    // Check if file already exists and add unique id
    if (file_exists($target_file)) {
        $target_file = $upload_dir . uniqid() . '_' . basename($file["name"]);
    }

    // Try to upload file
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        die("Sorry, there was an error uploading your file.");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $testimonial_text = $_POST['testimonial_text'];
    $user_name = $_POST['user_name'];
    $user_title = $_POST['user_title'];

    $upload_dir = "uploads/";
    $user_image = uploadImage($_FILES['user_image'], $upload_dir);
    $icon_image = uploadImage($_FILES['icon_image'], $upload_dir);

    $sql = "INSERT INTO testimonials (testimonial_text, user_name, user_title, user_image, icon_image)
            VALUES ('$testimonial_text', '$user_name', '$user_title', '$user_image', '$icon_image')";

    if ($conn->query($sql) === TRUE) {
        echo "New testimonial added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

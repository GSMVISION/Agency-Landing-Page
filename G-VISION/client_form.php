<?php
session_start();

include 'conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact_form (name, phone, email, message) VALUES ('$name', '$phone', '$email', '$message')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "<p style='color: green;'>Form submitted successfully!</p>";
    } else {
        $_SESSION['message'] = "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }

    $conn->close();

    header("Location: index.php"); // Redirect back to the form page
    exit();
}
?>

<?php
session_start();

include 'conn.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO client_pack (card_id, name, phone, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $card_id, $name, $phone, $email);

    // Set parameters and execute
    $card_id = $_POST['card_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    if ($stmt->execute()) {
        // Redirect back to the page after form submission
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

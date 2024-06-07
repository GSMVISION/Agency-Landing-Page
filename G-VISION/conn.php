<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gvision";

$conn = new mysqli($servername, $username, $password, $dbname);

// conn verfication
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
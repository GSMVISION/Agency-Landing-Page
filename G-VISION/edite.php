<?php
include 'conn.php';

// Directory where images will be saved
$imageDirectory = 'uploads/';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_feedback'])) {
    $id = $_POST['id'];
    $quote = $_POST['quote'];
    $author = $_POST['author'];
    $imagePath = $_POST['existing_image'];

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $imageDirectory . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo "Error uploading image.";
            $imagePath = $_POST['existing_image'];
        }
    }

    $sql = "UPDATE feedback SET quote = ?, author = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $quote, $author, $imagePath, $id);

    if ($stmt->execute() === TRUE) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    // Fetch feedback details for the given ID
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM feedback WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    } else {
        echo "No feedback ID provided.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/images/G-ICON.ico">
    <title>Edit Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        textarea,
        input[type="text"],
        input[type="file"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button {
            background-color: #040770;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #044777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Feedback</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="quote">Feedback:</label>
            <textarea id="quote" name="quote" required><?php echo htmlspecialchars($row['quote']); ?></textarea>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($row['author']); ?>" required>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image">
            <input type="hidden" name="existing_image" value="<?php echo $row['image']; ?>">
            <button type="submit" name="edit_feedback">Update Feedback</button>
        </form>
    </div>
</body>
</html>

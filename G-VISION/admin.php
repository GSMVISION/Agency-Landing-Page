<?php
include 'conn.php';

$imageDirectory = 'uploads/';

// Ensure the uploads path win troh img
if (!is_dir($imageDirectory)) {
    mkdir($imageDirectory, 0755, true);
}

// Handle form submission for adding a new feedback
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_feedback'])) {
    $quote = $_POST['quote'];
    $author = $_POST['author'];

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $imageDirectory . $imageName;

        // Move uploaded file to the uploads directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            $sql = "INSERT INTO feedback (quote, author, image) VALUES ('$quote', '$author', '$imagePath')";
            if ($conn->query($sql) === TRUE) {
                echo "New feedback added successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "No image uploaded or upload error.";
    }
}

// Handle deletion of a feedback
if (isset($_GET['delete_feedback'])) {
    $id = $_GET['delete_feedback'];
    $sql = "DELETE FROM feedback WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Feedback deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle deletion of a pack
if (isset($_GET['delete_student'])) {
    $id = $_GET['delete_student'];
    $sql = "DELETE FROM client_pack WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Feedback deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Handle deletion of a contact
if (isset($_GET['delete_student'])) {
    $id = $_GET['delete_student'];
    $sql = "DELETE FROM contact_form WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Feedback deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Fetch feedback entries
$sql_feedback = "SELECT * FROM feedback";
$result_feedback = $conn->query($sql_feedback);

$all_gsm_sql = "SELECT * FROM client_pack";
$all_gsm = $conn->query($all_gsm_sql);

$all_vision_sql = "SELECT * FROM contact_form";
$all_vision = $conn->query($all_vision_sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/images/G-ICON.ico">
    <title>GSM Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
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
            background-color: #044770;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        img {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <h1>Feedback Management Admin Dashboard</h1>
    <div class="container">
        <form method="POST" action="" enctype="multipart/form-data">
            <h2>Add a New Feedback</h2>
            <textarea name="quote" placeholder="Feedback" required></textarea>
            <input type="text" name="author" placeholder="Author" required>
            <input type="file" name="image" required>
            <button type="submit" name="add_feedback">Add Feedback</button>
        </form>
    </div>

    <div class="container">
        <h2>Confirmation Pack client </h2>
        <table>
            <tr>
                <th>ID</th>
                <th>card_id</th>
                <th>name</th>
                <th>phone</th>
                <th>email</th>
                <th>Manege</th>
            </tr>

            <?php
            
            if ($all_gsm->num_rows > 0) {
                while ($row = $all_gsm->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['card_id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['email']}</td>
                        <td>
                            <a href='admin.php?delete_student={$row['id']}'>Delete</a> 
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No Feedback Found</td></tr>";
            }
            ?>
        </table>
    </div>
    <div class="container">
        <h2>Call Center Data </h2>
        <table>
            <tr>
                <th>ID</th>
                <th>name</th>
                <th>phone</th>
                <th>email</th>
                <th>message</th>
                <th>date_send</th>
                <th>manage</th>

            </tr>

            <?php
            
            if ($all_vision->num_rows > 0) {
                while ($row = $all_vision->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['phone']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['message']}</td>
                        <td>{$row['date_send']}</td>
                        <td>
                            <a href='admin.php?delete_student={$row['id']}'>Delete</a> 
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No contact Found</td></tr>";
            }
            ?>
        </table>
    </div>

    <div class="container">
        <h2>Existing Feedback</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Feedback</th>
                <th>Author</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>

            <?php
            if ($result_feedback->num_rows > 0) {
                while ($row = $result_feedback->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['quote']}</td>
                        <td>{$row['author']}</td>
                        <td><img src='{$row['image']}' alt='{$row['author']}'></td>
                        <td>
                            <a href='admin.php?delete_feedback={$row['id']}'>Delete</a> |
                            <a href='edite.php?id={$row['id']}'>Edit</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No Feedback Found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

<?php
$conn->close();
?>
<?php
// DB connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$id = null;
$record = null;

// Fetch record for edit
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM registrations WHERE id = $id");
    if ($result && $result->num_rows > 0) {
        $record = $result->fetch_assoc();
    } else {
        die("Record not found.");
    }
}

// Update record
if (isset($_POST['update']) && $id !== null) {
    $studentName = $conn->real_escape_string($_POST['studentName']);
    $studentAge = intval($_POST['studentAge']);
    $studentParticipation = $conn->real_escape_string($_POST['studentParticipation']);
    
    $conn->query("UPDATE registrations SET studentName='$studentName', studentAge=$studentAge, studentParticipation='$studentParticipation' WHERE id=$id");
    
    header("Location: manage.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            background: white;
            margin: 50px auto;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"], 
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
        }
        input:focus {
            border-color: #007bff;
            outline: none;
        }
        .btn {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
            text-decoration: none;
            text-align: center;
        }
        .btn:hover {
            background: #0056b3;
        }
        .btn-secondary {
            background: #6c757d;
        }
        .btn-secondary:hover {
            background: #5a6268;
        }
        .actions {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Registration</h2>
    <form method="post">
        <label>Student Name:</label>
        <input type="text" name="studentName" value="<?= htmlspecialchars($record['studentName']) ?>" required>

        <label>Age:</label>
        <input type="number" name="studentAge" value="<?= htmlspecialchars($record['studentAge']) ?>" required>

        <label>Participation:</label>
        <input type="text" name="studentParticipation" value="<?= htmlspecialchars($record['studentParticipation']) ?>" required>

        <div class="actions">
            <button type="submit" name="update" class="btn">Update</button>
            <a href="manage.php" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
</body>
</html>

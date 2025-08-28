<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "expo";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete record if requested
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM registrations WHERE id = $id");
    header("Location: manage.php");
    exit;
}

// Fetch data
$sql = "SELECT * FROM registrations ORDER BY id ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Registrations</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 15px;
        background-color: #f8f9fa;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    .table-container {
        overflow-x: auto; /* Enable horizontal scroll on small devices */
        background: white;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    table {
        border-collapse: collapse;
        width: 100%;
        min-width: 800px; /* Prevent too small table on mobile */
    }
    th, td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
        vertical-align: middle;
    }
    th {
        background: #007BFF;
        color: white;
        font-weight: bold;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #eaf4ff;
    }
    .action-buttons {
        display: flex;
        gap: 6px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .action-buttons a {
        padding: 6px 10px;
        border-radius: 4px;
        color: white;
        text-decoration: none;
        font-size: 14px;
        transition: 0.3s ease;
    }
    .edit-btn {
        background-color: #28a745;
    }
    .edit-btn:hover {
        background-color: #218838;
    }
    .delete-btn {
        background-color: #dc3545;
    }
    .delete-btn:hover {
        background-color: #c82333;
    }

    /* Tablet view */
    @media (max-width: 768px) {
        th, td {
            padding: 8px;
            font-size: 13px;
        }
        .action-buttons a {
            font-size: 12px;
            padding: 5px 8px;
        }
    }

    /* Mobile view */
    @media (max-width: 480px) {
        body {
            padding: 8px;
        }
        h2 {
            font-size: 18px;
        }
        table {
            font-size: 12px;
        }
        th, td {
            padding: 6px;
        }
        .action-buttons a {
            font-size: 11px;
            padding: 4px 6px;
        }
    }
</style>
</head>
<body>

<h2>Manage Competition Registrations</h2>

<div class="table-container">
    <table>
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Age</th>
            <th>Participation</th>
            <th>Parent Name</th>
            <th>Has Sibling</th>
            <th>Sibling Name</th>
            <th>Sibling Age</th>
            <th>Sibling Participation</th>
            <th>Parent Phone</th>
            <th>Parent Email</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['studentName']) ?></td>
            <td><?= $row['studentAge'] ?></td>
            <td><?= htmlspecialchars($row['studentParticipation']) ?></td>
            <td><?= htmlspecialchars($row['parentName']) ?></td>
            <td><?= $row['hasSibling'] ?></td>
            <td><?= htmlspecialchars($row['siblingName']) ?></td>
            <td><?= $row['siblingAge'] ?></td>
            <td><?= htmlspecialchars($row['siblingParticipation']) ?></td>
            <td><?= htmlspecialchars($row['parentPhone']) ?></td>
            <td><?= htmlspecialchars($row['parentEmail']) ?></td>
            <td><?= $row['created_at'] ?></td>
            <td>
                <div class="action-buttons">
                    <a href="edit.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
                    <a href="manage.php?delete=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                </div>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
<?php $conn->close(); ?>

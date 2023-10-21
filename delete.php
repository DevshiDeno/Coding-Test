<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $database = "loan Calculator";
    $username = "root";
    $password = "yes";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];

    // Use a prepared statement to avoid SQL injection
    $query = $conn->prepare("DELETE FROM loan WHERE id = ?");
    $query->bind_param("i", $id);

    if ($query->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => $query->error]);
    }

    $query->close(); // Close the prepared statement
    $conn->close(); // Close the database connection
}
?>
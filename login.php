<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Perform user authentication by querying the database
    $servername = "localhost";
    $database = "loan Calculator";
    $username_db = "root";
    $password_db = "yes";

    // Establish a database connection
    $conn = new mysqli($servername, $username_db, $password_db, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform a query to retrieve user information
    $query = $conn->prepare("SELECT * FROM users WHERE admin = ? AND password = ?");
    $query->bind_param("ss", $username, $password);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // Authentication successful
        $_SESSION["username"] = $username;
        header("Location: home.php"); 
        exit();
    } else {
        // Authentication failed
        $error_message = "Invalid username or password. Please try again.";
    }
    
    if (isset($error_message)) {
        echo "<script>alert('Invalid username or password. Please try again.');
        window.location = 'index.php'; // Redirect to index.php
        </script>";

    }


    $query->close();
    $conn->close();
}
?>

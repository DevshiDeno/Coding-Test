<?php
$servername = "localhost";
$database = "loan Calculator";
$username = "root";
$password = "yes";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = $conn->query("SELECT * FROM loan ORDER BY id");
if (!$query) {
    die("Error in SQL query: " . $conn->error);
}

$json_array = array();

while ($row = $query->fetch_assoc()) {
    $json_item = array(
        "id" => $row["id"],
        "Borrower_name" => $row["Borrower_name"],
        "Loan_amount" => $row["Loan_amount"],
        "Interest_type" => $row["Interest_type"],
        "Loan_period" => $row["Loan_period"],
        "bank" => $row["bank"],
        "Monthly_Installment" => $row["Monthly_Installment"],
        "start_date" => $row["start_date"],
        "take_home_amount" => $row["take_home_amount"],
    );

    $json_array[] = $json_item;
}

$conn->close();

echo json_encode(array("data" => $json_array));
$db_json_file = 'C:\xampp2\htdocs\api/db.json';

// Write the JSON data to the db.json file
file_put_contents($db_json_file, json_encode(array("data" => $json_array)));
?>
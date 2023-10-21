<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $payment_frequency = $_POST["frequency_Type"];
    $borrower_name = $_POST["borrower_name"];
    $loan_purpose = $_POST["loan_purpose"];
    $loan_amount = $_POST["loan_amount"];
    $interest_type = $_POST["interest_type"];
    $loan_period = $_POST["loan_period"];
    $bank = $_POST["bank"];
    $Processing_fees = (3 / 100) * $loan_amount;
    $ExciseDuty = (20 / 100) * $Processing_fees;
    $LegalFees = 10000;
    $fees = $LegalFees + $ExciseDuty + $Processing_fees;
    // Define interest rates for Bank A and Bank B
    $bank_interest_rates = [
        "Bank A" => [
            "Flat Rate" => 0.20,
            // 20% p.a.
            "Reducing Balance" => 0.22,
            // 22% p.a.
        ],
        "Bank B" => [
            "Flat Rate" => 0.18,
            // 18% p.a.
            "Reducing Balance" => 0.25,
            // 25% p.a.
        ],
    ];

    // Perform loan calculations based on interest type and bank
    $annual_interest_rate = $bank_interest_rates[$bank][$interest_type];
    $monthly_interest_rate = $annual_interest_rate / 12;
    $total_months = $loan_period * 12;
    $monthly_installment = ($loan_amount * $monthly_interest_rate) / (1 - (1 + $monthly_interest_rate) ** $total_months) + $fees;
    $take_home_amount = $loan_amount - $fees;

    // // Display loan details
    // echo "<h3>Loan Details:</h3>";
    // echo "Borrower's Name: $borrower_name<br>";
    // //echo "Loan Purpose: $loan_purpose<br>";
    // echo "Loan Amount: $loan_amount<br>";
    // echo "Interest Type: $interest_type<br>";
    // echo "Loan Period: $loan_period years<br>";
    // echo "Payment Frequency: $payment_frequency<br>";
    // echo "Bank: $bank<br>";
    // // "Adittional Fees: $fees<br>";
    // echo "Monthly Installment: $monthly_installment";

    // Establish a database connection)
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

    // Define your data
    $borrower_name = $conn->real_escape_string($borrower_name); // Sanitize user input
    $loan_amount = $conn->real_escape_string($loan_amount);
    $interest_type = $conn->real_escape_string($interest_type);
    $loan_period = $conn->real_escape_string($loan_period);
    $payment_frequency = $conn->real_escape_string($payment_frequency);
    $bank = $conn->real_escape_string($bank);
    $monthly_installment = $conn->real_escape_string($monthly_installment);
    $take_home_amount = $conn->real_escape_string($take_home_amount);
    // Create and execute the SQL INSERT statement
    $sql = "INSERT INTO loan (Borrower_name, Loan_amount, Interest_type, Loan_period, Payment_Frequency, Bank, Monthly_Installment,take_home_amount)
        VALUES ('$borrower_name', '$loan_amount', '$interest_type', '$loan_period', '$payment_frequency', '$bank', '$monthly_installment','$take_home_amount')";

    if ($conn->query($sql) === TRUE) {
        // echo "Data inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;

    }
    $conn->close();
}

?>
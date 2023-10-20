<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technical Assesment</title>
   
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
   <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="scripts/main.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
</head>

<body>

    <div class="first-container">
        <p>Code Test: Loan Calculator</p>
    </div>
    <table border="1" class="bank-table">
        <tr>
            <th>Bank</th>
            <th>Flat Interest Rate</th>
            <th>Reducing Balance Rate</th>
        </tr>
        <tr>
            <td>Bank A</td>
            <td>20% p.a.</td>
            <td>22% p.a.</td>
        </tr>
        <tr>
            <td>Bank B</td>
            <td>18% p.a.</td>
            <td>25% p.a.</td>
        </tr>
    </table>
    <div >
        <button id="loan-details">Press to enter loan details</button>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form id="addForm" method="POST" >
                <div >
                        <h3>Fill in Details:</h3>
                        <label for="borrower_name">Borrower's Name:</label>
                        <input type="text" id="borrower_name" name="borrower_name" required><br>

                        <label for="loan_purpose">Loan Purpose:</label>
                        <input type="text" id="loan_purpose" name="loan_purpose"><br>

                        <label for="loan_amount">Requested Loan Amount:</label>
                        <input type="number" id="loan_amount" name="loan_amount" required min="10000"><br>
                        <label class="info-label">Minimum loan amount is 20,000</label><label for="interest_type">Interest Type:</label>
                        <select id="interest_type" name="interest_type">
                            <option value="Flat Rate">Flat Rate</option>
                            <option value="Reducing Balance">Reducing Balance</option>
                        </select><br>

                        <label for="loan_period">Requested Loan Period (in years):</label>
                        <input type="number" id="loan_period" name="loan_period" required><br>

                        <label for="bank_Type">Choose Bank </label>
                        <select id="bank_Type" name="bank">
                            <option value="Bank A">Bank A</option>
                            <option value="Bank B">Bank B</option>
                        </select><br>
                        <label for="frequency_Type">Payment Frequency</label>
                        <select id="frequency_Type" name="frequency_Type">
                            <option value="Annually">Annually</option>
                            <option value="Quarterly">Quarterly</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Every 6 Months">Every 6 Months</option>
                        </select><br>
                        <div class="fee-container">
                            <p>Other Fees include: 3% Processing Fees,
                                Excise Duty 20% of the Processing fees,
                                Legal Fees Ksh.10000
                            </p>

                        </div>
                </div>
                <input type="submit" value="Submit Loan Details" id="submit">
            </form>
        </div>
    </div>


    <div>
        <table id="myTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Borrower name</th>
                    <th>Loan amount</th>
                    <th>Interest type</th>
                    <th>loan period</th>
                    <th>Bank Type</th>
                    <th>Monthly Installments</th>
                    <th>Date started</th>
                    <th>Take Home Amount</th>

                </tr>
            </thead>
        
            <tfoot>
                <tr>
                    <th>Borrower name</th>
                    <th>Loan amount</th>
                    <th>Interest type</th>
                    <th>loan period</th>
                    <th>Bank Type</th>
                    <th>Monthly Installments</th>
                    <th>Date started</th>
                    <th>Take Home Amnt</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div id="fees-container">
        <div class="fee">
            <span class="fee-description">Processing Fees:</span>
            <span class="fee-amount">3%</span>
        </div>
        <div class="fee">
            <span class="fee-description">Excise Duty:</span>
            <span class="fee-amount">20% of Processing Fees</span>
        </div>
        <div class="fee">
            <span class="fee-description">Legal Fees:</span>
            <span class="fee-amount">KES 10,000</span>
        </div>
        <p>Are substracted from the loan amount</p>
    </div>
    
</body>

</html>
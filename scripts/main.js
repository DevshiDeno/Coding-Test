$(document).ready(function () {
    var modal = $("#myModal");
    var btn = $("#loan-details");
    var span = $(".close");
    var addForm = $("#addForm");

    var table = $("#myTable").DataTable({
        ajax: {
            url: 'server_processing.php',
            dataSrc: 'data' // Ensure this matches the key in your JSON response
        },
        processing: true,
        serverSide: true,
        columns: [
            { data: 'Borrower_name' },
            { data: 'Loan_amount' },
            { data: 'Interest_type' },
            { data: 'Loan_period' },
            { data: 'bank' },
            { data: 'Monthly_Installment' },
            { data: 'start_date' },
            { data: 'take_home_amount' },

        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',

        ],
    });


    // When the user clicks on the button, open the modal

    btn.click(function () {
        modal.css("display", "block");
    });
    // When the user clicks on <span> (x), close the modal
    span.click(function () {
        modal.css("display", "none");
    });

    // When the user clicks anywhere outside of the modal, close it
    $(window).click(function (event) {
        if (event.target == modal[0]) { // Check if target is not the modal
            modal.css("display", "none");
        }
    });

    // When the user submits the form
    addForm.submit(function (event) {
        event.preventDefault(); // Prevent the default form submission

     // Clear the form fields
     $("#borrower_name").val("");
     $("#loan_purpose").val("");
     $("#loan_amount").val("");
     $("#interest_type").val("Flat Rate");
     $("#loan_period").val("");
     $("#bank_Type").val("Bank A");
     $("#frequency_Type").val("Monthly");

        // Serialize the form data
        var formData = addForm.serialize();

        $.ajax({
            type: "POST",
            url: "insert.php", // Change to the appropriate URL
            data: formData,
            success: function (response) {
                // Handle the response, e.g., display a success message
                console.log("Form submitted successfully.");
                modal.css("display", "none");

                table.ajax.reload()

                // // Update the DataTable with the new data
                // DataTable.ajax.reload(); // Reload the DataTable to refresh the table with the new data

                // // Close the modal after a successful submission
                // modal.css("display", "none");
            },
            error: function (xhr, status, error) {
                // Handle errors, e.g., display an error message
                console.error("Form submission error: " + error);
            }
        });
    });
});
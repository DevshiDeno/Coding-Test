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
            { data: "id",
                "render": function (data, type, row) {
                    return '<button data-id="' + row.id + '" class="delete-btn">Delete</button>';
                }
            },
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
        if (event.target == modal[0]) { 
            modal.css("display", "none");
        }
    });

    // When the user submits the form
    addForm.submit(function (event) {
        event.preventDefault(); // Prevent the default form submission
    
 
        // Serialize the form data
        var formData = addForm.serialize();
     // Clear the form fields
     $("#borrower_name").val("");
     $("#loan_purpose").val("");
     $("#loan_amount").val("");
     $("#interest_type").val("Flat Rate");
     $("#loan_period").val("");
     $("#bank_Type").val("Bank A");
     $("#frequency_Type").val("Monthly");
        var url = "insert.php"; // Change to the appropriate URL
    
        if (url) {
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success: function (response) {
                    // Handle the response, e.g., display a success message
                    console.log("Form submitted successfully.");
                    modal.css("display", "none");
                    table.ajax.reload();
                },
                error: function (xhr, status, error) {
                    // Handle errors, e.g., display an error message
                    console.error("Form submission error: " + error);
                }
            });
        }
    });
    

    $("#myTable").on("click", ".delete-btn", function () {
        var id = $(this).data("id");
        deleteRow(id);
    });

        function deleteRow(id) {
            $.ajax({
                url: "delete.php",
                type: "POST",
                data: { id: id },
                success: function (data) {
                    table.ajax.reload();
                }
            })
        }
});
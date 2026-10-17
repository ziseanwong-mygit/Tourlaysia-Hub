<?php include 'staff_header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Receipt</title>
    <link rel="stylesheet" href="./staff_styles/styles.css">
    <link rel="stylesheet" href="./staff_styles/add_bill_payment_invoice.css">
</head>
<body>

<div class="container">
    <button onclick="history.back()" class="back-btn">← Back</button>
    <h1>Add Receipt</h1>

    <div class="form-box">
        <label for="rcp_ID">Receipt ID:</label>
        <input type="text" id="rcp_ID" required>

        <label for="bil_ID">Bill ID:</label>
        <input type="text" id="bil_ID" required>

        <label for="pyt_ID">Payment ID:</label>
        <input type="text" id="pyt_ID" required>

        <label for="rcp_date">Receipt Date:</label>
        <input type="date" id="rcp_date" required>

        <label for="pyr_name">Payer Name:</label>
        <input type="text" id="pyr_name" required>

        <label for="pyr_email">Payer Email:</label>
        <input type="email" id="pyr_email" required>

        <label for="tot_amount">Total Amount:</label>
        <input type="number" id="tot_amount" step="0.01" required>

        <label for="svc_charge">Service Charge:</label>
        <input type="number" id="svc_charge" step="0.01" required>

        <label for="add_charge">Additional Charge:</label>
        <input type="number" id="add_charge" step="0.01">

        <label for="pd_amount">Paid Amount:</label>
        <input type="number" id="pd_amount" step="0.01" required>

        <label for="pyt_option">Payment Option:</label>
        <input type="text" id="pyt_option" required>

        <label for="plt_name">Payment Location:</label>
        <input type="text" id="plt_name" required>

        <label for="pyt_date">Payment Date:</label>
        <input type="date" id="pyt_date" required>

        <label for="rcp_remark">Receipt Remark:</label>
        <input type="text" id="rcp_remark">

        <div class="button-group">
            <button type="button" onclick="resetForm()">Cancel</button>
            <button type="button" onclick="submitReceipt()">Add Receipt</button>
        </div>
    </div>
</div>

<script>
function resetForm() {
    document.getElementById('bil_ID').value = '';
    document.getElementById('pyt_ID').value = '';
    document.getElementById('rcp_date').value = '';
    document.getElementById('pyr_name').value = '';
    document.getElementById('pyr_email').value = '';
    document.getElementById('tot_amount').value = '';
    document.getElementById('svc_charge').value = '';
    document.getElementById('add_charge').value = '';
    document.getElementById('pd_amount').value = '';
    document.getElementById('pyt_option').value = '';
    document.getElementById('plt_name').value = '';
    document.getElementById('pyt_date').value = '';
    document.getElementById('rcp_remark').value = '';
}

function submitReceipt() {
    // Collect data and handle submission logic here
    alert('Receipt added successfully!');
}
</script>

<?php include 'staff_footer.php'; ?>
</body>
</html>


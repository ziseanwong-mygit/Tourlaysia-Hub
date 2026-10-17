<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Timeslot</title>
    <link rel="stylesheet" href="./staff_styles/tyles.css">
    <link rel="stylesheet" href="./staff_styles/add_bill_payment_invoice.css">
</head>
<body>

<div class="container">
    <button onclick="history.back()" class="back-btn">← Back</button>
    <h1>Add Timeslot - Part 2</h1>

    <div class="form-box">
        <label for="tsl_list_ID">Timeslot List ID:</label>
        <input type="text" id="tsl_list_ID" required>

        <label for="scd_ID">Schedule ID:</label>
        <input type="text" id="scd_ID" required>

        <label for="tsl_date">Timeslot Date:</label>
        <input type="date" id="tsl_date" required>

        <label for="tsl_time">Timeslot Time:</label>
        <input type="time" class="tsl_time" required>

        <label for="tsl_day">Timeslot Day:</label>
        <input type="text" class="tsl_day" required>

        <label for="tsl_transp">Timeslot Transportation:</label>
        <input type="text" class="tsl_transp" required>

        <label for="tsl_task">Timeslot Task:</label>
        <input type="text" class="tsl_task" required>

        <div class="button-group">
            <button type="button" onclick="resetForm()">Cancel</button>
            <button type="button" onclick="submitBill()">Add Trip Schedule</button>
        </div>
    </div>
</div>

<script>
function addItem() {
    const itemFields = document.getElementById('item-fields');
    const newItem = document.createElement('div');
    newItem.classList.add('item');
    newItem.innerHTML = `
        <label for="tsl_list_ID">Timeslot List ID:</label>
        <input type="text" id="tsl_list_ID" required>
        <label for="scd_ID">Schedule ID:</label>
        <input type="text" id="scd_ID" required>
        <label for="tsl_date">Timeslot Date:</label>
        <input type="date" id="tsl_date" required>
        <label for="tsl_time">Timeslot Time:</label>
        <input type="time" class="tsl_time" required>
        <label for="tsl_day">Timeslot Day:</label>
        <input type="text" class="tsl_day" required>
        <label for="tsl_transp">Timeslot Transportation:</label>
        <input type="text" class="tsl_transp" required>
        <label for="tsl_task">Timeslot Task:</label>
        <input type="text" class="tsl_task" required>
    `;
    itemFields.appendChild(newItem);
}

function removeItem(button) {
    button.parentElement.remove();
}

function resetForm() {
    document.getElementById('item-fields').innerHTML = `
        <h3>Items</h3>
        <div class="item">
        <label for="tsl_list_ID">Timeslot List ID:</label>
        <input type="text" id="tsl_list_ID" required>
        <label for="scd_ID">Schedule ID:</label>
        <input type="text" id="scd_ID" required>
        <label for="tsl_date">Timeslot Date:</label>
        <input type="date" id="tsl_date" required>
        <label for="tsl_time">Timeslot Time:</label>
        <input type="time" class="tsl_time" required>
        <label for="tsl_day">Timeslot Day:</label>
        <input type="text" class="tsl_day" required>
        <label for="tsl_transp">Timeslot Transportation:</label>
        <input type="text" class="tsl_transp" required>
        <label for="tsl_task">Timeslot Task:</label>
        <input type="text" class="tsl_task" required>
        </div>
    `;
    document.getElementById('tsl_list_ID').value = '';
    document.getElementById('scd_ID').value = '';
    document.getElementById('tsl_date').value = '';
    document.getElementById('tsl_time').value = '';
    document.getElementById('tsl_day').value = '';
    document.getElementById('tsl_transp').value = '';
    document.getElementById('tsl_task').value = '';
}

function submitBill() {
    // Collect data and handle submission logic here
    alert('Trip Schedule added successfully!');
}
</script>

<?php include 'staff_footer.php'; ?>
</body>
</html>
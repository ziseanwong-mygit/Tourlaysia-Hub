<!-- Programmer Name: Tei Yu Hong, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: manageBillPaymentReceipt.php -->
<!-- Description: This page allows staff to manage bill, payment, and receipt -->
<!-- Date first written: 1/7/2025 -->
<!-- Date last modified: 12/7/2025 -->

<?php
    include('./staff_crud/db_connection.php');
    $search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';
    include('staff_header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/styles.css">
    <link rel="stylesheet" href="./staff_styles/manageBillPaymentReceipt.css">
</head>
<body>
    <div class="page-header">
        <h1>Manage Bill, Payment & Receipt</h1>
        <p>Manage and update billing-related records.</p>
    </div>

  <div class="controls-container">
      <div class="search-container">
          <form action="" method="GET" class="searchbar">
              <input type="search" placeholder="Search..." class="search-input" name="search" value="<?php echo htmlspecialchars($search); ?>">
              <button type="submit" class="search-btn">
                  <img src="https://img.icons8.com/ios7/600/search.png" alt="Search">
              </button>
          </form>
      </div>

      <div class="dropdown-wrapper">
          <button class="dropdown-button">
              <img src="https://cdn-icons-png.flaticon.com/512/60/60995.png" alt="Dropdown" class="dropdown-icon">
              <span>Add</span>
          </button>
          <ul class="dropdown-menu">
              <li><a href="add_bill_form.php" >Bill</a></li>
              <li><a href="add_payment.php">Payment</a></li>
              <li><a href="add_receipt.php">Receipt</a></li>
          </ul>
      </div>
  </div>

  <div class="table-section">
      <div class="table-title">Bill List</div>
          <div class="table-container">
              <table class="bill-table">
                <thead>
                    <tr>
                        <th>Bill ID</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>User Email</th>
                        <th>Subtotal Amount</th>
                        <th>Service Charge</th>
                        <th>Additional Charge</th>
                        <th>Total Amount</th>
                        <th>Staff Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      $bill_query = "SELECT * FROM bill_rec_t";
                      if (!empty($search)) {
                        $bill_query .= " WHERE bil_ID LIKE '%$search%' 
                                        OR usr_ID LIKE '%$search%' 
                                        OR usr_name LIKE '%$search%'";
                      }
                    $bill_result = mysqli_query($connection, $bill_query);
                    $bill_count = mysqli_num_rows($bill_result);

                    while ($row = mysqli_fetch_assoc($bill_result)) {
                      echo "<tr>";
                      echo "<td>{$row['bil_ID']}</td>";
                      echo "<td>{$row['usr_ID']}</td>";
                      echo "<td>{$row['usr_name']}</td>";
                      echo "<td>{$row['usr_email']}</td>";
                      echo "<td>{$row['sbt_amount']}</td>";
                      echo "<td>{$row['svc_charge']}</td>";
                      echo "<td>{$row['add_charge']}</td>";
                      echo "<td>{$row['tot_amount']}</td>";
                      echo "<td>{$row['stf_name']}</td>";
                      echo "<td><button class='manage-btn' onclick=\"window.location.href='mng_billInfo.php?billID={$row['bil_ID']}'\">Manage</button>
                          </td>";
                      echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
      </div>
      <div class="result-wrapper">
        <p class="result-count">Showing <?php echo $bill_count; ?> result(s)</p>
      </div>
  </div>

  <div class="table-section">
      <div class="table-title">Payment List</div>
          <div class="table-container">
              <table class="payment-table">
                  <thead>
                      <tr>
                          <th>Payment ID</th>
                          <th>Bill ID</th>
                          <th>Bill ID</th>
                          <th>Payer Name</th>
                          <th>Total Amount</th>
                          <th>Paid Amount</th>
                          <th>Payment Option</th>
                          <th>Platform Name</th>
                          <th>POP Image Name</th>
                          <th>Payment Date</th>
                          <th>Payment Status</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <?php
                  $payment_query = "SELECT * FROM payment_rec_t";
                  if (!empty($search)) {
                      $payment_query .= " WHERE pyt_ID LIKE '%$search%' 
                                        OR bil_ID LIKE '%$search%' 
                                        OR usr_ID LIKE '%$search%' 
                                        OR usr_name LIKE '%$search%'";
                    }
                  $payment_result = mysqli_query($connection, $payment_query);
                  $payment_count = mysqli_num_rows($payment_result);

                  while ($row = mysqli_fetch_assoc($payment_result)) {
                    echo "<tr>";
                    echo "<td>{$row['pyt_ID']}</td>";
                    echo "<td>{$row['bil_ID']}</td>";
                    echo "<td>{$row['usr_ID']}</td>";
                    echo "<td>{$row['usr_name']}</td>";
                    echo "<td>{$row['tot_amount']}</td>";
                    echo "<td>{$row['pd_amount']}</td>";
                    echo "<td>{$row['pyt_option']}</td>";
                    echo "<td>{$row['plt_name']}</td>";
                    echo "<td>{$row['POP_img_name']}</td>";
                    echo "<td>{$row['pyt_date']}</td>";
                    echo "<td>{$row['pyt_status']}</td>";
                    echo "<td><button class='manage-btn' onclick=\"window.location.href='mng_paymentInfo.php?payID={$row['pyt_ID']}'\">Manage</button>
                        </td>";
                    echo "</tr>";
                  }
                  ?>
              </table>
        </div>
        <div class="result-wrapper">
            <p class="result-count">Showing <?php echo $payment_count; ?> result(s)</p>
        </div>
  </div>

  <div class="table-section">
      <div class="table-title">Receipt List</div>
          <div class="table-container">
            <table class="invoice-table">
                <thead>
                  <tr>
                    <th>Receipt ID</th>
                    <th>Bill ID</th>
                    <th>Payment ID</th>
                    <th>Receipt Date</th>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Subtotal Amount</th>
                    <th>Service Charge</th>
                    <th>Additional Charge</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Payment Option</th>
                    <th>Platform Name</th>
                    <th>Payment Date</th>
                    <th>Receipt Remark</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <?php
                $receipt_query = "SELECT * FROM receipt_rec_t";
                if (!empty($search)) {
                    $receipt_query .= " WHERE rcp_ID LIKE '%$search%' 
                                      OR bil_ID LIKE '%$search%'
                                      OR pyt_ID LIKE '%$search%'
                                      OR usr_ID LIKE '%$search%' 
                                      OR usr_name LIKE '%$search%'";
                  }
                $receipt_result = mysqli_query($connection, $receipt_query);
                $receipt_count = mysqli_num_rows($receipt_result);

                while ($row = mysqli_fetch_assoc($receipt_result)) {
                  echo "<tr>";
                  echo "<td>{$row['rcp_ID']}</td>";
                  echo "<td>{$row['bil_ID']}</td>";
                  echo "<td>{$row['pyt_ID']}</td>";
                  echo "<td>{$row['rcp_date']}</td>";
                  echo "<td>{$row['usr_ID']}</td>";
                  echo "<td>{$row['usr_name']}</td>";
                  echo "<td>{$row['usr_email']}</td>";
                  echo "<td>{$row['sbt_amount']}</td>";
                  echo "<td>{$row['svc_charge']}</td>";
                  echo "<td>{$row['add_charge']}</td>";
                  echo "<td>{$row['tot_amount']}</td>";
                  echo "<td>{$row['pd_amount']}</td>";
                  echo "<td>{$row['pyt_option']}</td>";
                  echo "<td>{$row['plt_name']}</td>";
                  echo "<td>{$row['pyt_date']}</td>";
                  echo "<td>{$row['rcp_remark']}</td>";
                  echo "<td><button class='manage-btn' onclick=\"window.location.href='mng_receiptInfo.php?rcpID={$row['rcp_ID']}'\">Manage</button>
                      </td>";
                  echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div class="result-wrapper">
          <p class="result-count">Showing <?php echo $receipt_count; ?> result(s)</p>
        </div>
    </div>

    <?php include('staff_footer.php'); ?>
</body>
</html>


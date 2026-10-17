<!-- Programmer Name: Tei Yu Hong, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: bookingFormPage2.php -->
<!-- Description: To create booking form page to allow users to book travel. -->
<!-- Date first written: 14/6/2025 -->
<!-- Date last modified: 14/7/2025 -->

<?php
    session_start();
    include('./crud/db_connection.php');

    // Utility function for ID generation
    function generateID($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // Store POST data from Page 1 only if coming from Page 1 (via POST and with pkg_ID)
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['pkg_ID'])) {
        $_SESSION['booking'] = [
            'fullname'   => $_POST['fullname'],
            'email'      => $_POST['email'],
            'ic'         => $_POST['ic'],
            'phone'      => $_POST['phone'],
            'pax'        => $_POST['pax'],
            'pkg_ID'     => $_POST['pkg_ID'],
            'pkg_dest'   => $_POST['pkg_dest'],
            'insurance'  => isset($_POST['insurance']) ? 1 : 0,
            'agree'      => isset($_POST['agree']) ? 1 : 0,
        ];
    } elseif (!isset($_SESSION['booking']['pkg_ID'])) {
        echo "<script>alert('Invalid access. Please try again.'); window.location.href='home_page.php';</script>";
        exit;
    }

    // If proceeding to next page
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['next_page'])) {
        $_SESSION['members'] = $_POST['members'];
        header("Location: bookingFormPage3.php");
        exit;
}

    include('header.php');

    $pax = (int)$_SESSION['booking']['pax'];
    $bkn_ID = 'BKN_' . generateID(10);
    $_SESSION['bkn_ID'] = $bkn_ID;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/bookingFormPage.css">
</head>
<body>
<div class="form-container">
    <h3>Member Details</h3>
    <div class="instruction-box">
        <h4>Instructions:</h4>
        <ol>
            <li style="color: red;">* Required field</li>
            <li>Enter all member details as per IC/Passport.</li>
        </ol>
    </div>

    <form action="" method="POST">
        <input type="hidden" name="bkn_ID" value="<?= htmlspecialchars($bkn_ID) ?>">
        <?php for ($i = 1; $i <= $pax; $i++): ?>
        <div class="form-grid">
            <h4>Member <?= $i ?></h4>
            <div>
                <label for="mbr_doc_ID_<?= $i ?>"><span>* </span> Member Document ID</label>
                <input type="text" id="mbr_doc_ID_<?= $i ?>" name="members[<?= $i ?>][doc_ID]" required pattern="[A-Za-z0-9\-]{6,20}">
            </div>
            <div>
                <label for="mbr_name_<?= $i ?>"><span>* </span> Member Name</label>
                <input type="text" id="mbr_name_<?= $i ?>" name="members[<?= $i ?>][name]" required pattern="[A-Za-z\s]{3,50}">
            </div>
            <input type="hidden" name="members[<?= $i ?>][seqNo]" value="<?= $i ?>">
            <input type="hidden" name="members[<?= $i ?>][mbr_ls_ID]" value="BMBR_<?= generateID() ?>">
        </div>
        <?php endfor; ?>

        <div class="form-btn">
            <a href="javascript:history.back()" class="form-btn-back">Back</a>
            <button type="submit" name="next_page" class="form-btn-next">Next</button>
        </div>
    </form>
</div>
<?php include 'footer.php'; ?>
</body>
</html>
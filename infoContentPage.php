<!-- Programmer Name: Tei Yu Hong, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: infoContentPage.php -->
<!-- Description: This page allows staff to manage bill, payment, and receipt -->
<!-- Date first written: 1/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include('./crud/db_connection.php');
    include('header.php');

    // Get info site ID from URL
    if (!isset($_GET['ist_ID'])) {
        die("<h2 style='text-align:center;'>Information ID not provided.</h2>");
    }

    $ist_ID = mysqli_real_escape_string($connection, $_GET['ist_ID']);

    // Query info_site_t table
    $query = "SELECT * FROM info_site_t WHERE ist_ID = '$ist_ID' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if (!$result || mysqli_num_rows($result) === 0) {
        die("<h2 style='text-align:center;'>Information not found.</h2>");
    }

    $info = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tourlaysia - Info</title>
    <link rel="stylesheet" href="./styles/infoContentPage.css">
</head>
<body>

<div class="back-nav">
    <button onclick="window.location.href='infoMainPage.php'">
        <img src="https://cdn-icons-png.flaticon.com/128/130/130882.png" alt="Back">
        <h3>Back to Info</h3>
    </button>
</div>

<div class="info-container">
    <img class="info-image" src="<?php echo $info['ist_img']; ?>" alt="Info Image" onerror="this.onerror=null; this.src='./img/placeholder-pic.jpg'">
    <div class="info-author">Author: <?= htmlspecialchars($info['ist_author']) ?></div>
    <div class="info-date">Date: <?= htmlspecialchars($info['ist_date_create']) ?></div>

    <div class="info-main">
        <div class="info-title"><?= htmlspecialchars($info['ist_title']) ?></div>
        <div class="info-content" style="font-style:italic;">
            <?= nl2br(htmlspecialchars($info['ist_desc'])) ?>
        </div>
        <div class="info-content">
            <?= nl2br(htmlspecialchars($info['ist_cont'])) ?>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>

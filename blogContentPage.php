<!-- Programmer Name: Tei Yu Hong, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: blogContentPage.php -->
<!-- Description: This page displays the content of a blog post -->
<!-- Date first written: 1/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include('./crud/db_connection.php');
    include('header.php');
    include('nav_bar.php');

    // Get blog ID from URL
    if (!isset($_GET['blg_ID'])) {
        die("<h2 style='text-align:center;'>Blog ID not provided.</h2>");
    }

    $blg_ID = mysqli_real_escape_string($connection, $_GET['blg_ID']);

    // Query blog data
    $query = "SELECT * FROM blog_t WHERE blg_ID = '$blg_ID' LIMIT 1";
    $result = mysqli_query($connection, $query);

    if (!$result || mysqli_num_rows($result) === 0) {
        die("<h2 style='text-align:center;'>Blog not found.</h2>");
    }

    $blog = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/blogContentPage.css">
</head>
<body>

<div class="back-nav">
    <button onclick="window.location.href='blogMainPage.php'">
        <img src="https://cdn-icons-png.flaticon.com/128/130/130882.png" alt="Back">
        <h3>Back to Blog</h3>
    </button>
</div>

<div class="blog-container">
    <img class="blog-image" src="<?php echo $blog['blg_img']?>" alt="<?= htmlspecialchars($blog['blg_title']) ?>" onerror="this.onerror=null; this.src='./img/placeholder-pic.jpg'">
    <div class="blog-author">Author: <?= htmlspecialchars($blog['blg_author']) ?></div>
    <div class="blog-date">Date: <?= htmlspecialchars($blog['blg_date_create']) ?></div>
    <div class="blog-main">
    <div class="blog-title"><?= htmlspecialchars($blog['blg_title']) ?></div>
        <div class="blog-content">
            <span style="font-style:italic;"><?= nl2br(htmlspecialchars($blog['blg_desc'])) ?></span>
        </div>
        <div class="blog-content">
            <?= nl2br(htmlspecialchars($blog['blg_cont'])) ?>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>
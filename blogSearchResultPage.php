<!-- Programmer Name: Seath Tan Ziren & Tei Yu Hong, Group Members of Peaky Blinders, AAPP011-4-2 Capstone Project
Project Name: blogSearchResultPage.php
Description: To create search blog page to allow users to search blog and info.
Date first written: 14/6/2025
Date last modified: 13/7/2025 -->


<?php
    include('./crud/db_connection.php');
    include('header.php');

    $search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

    $sql = "SELECT * FROM blog_t 
            WHERE blg_ID LIKE '%$search%' 
            OR blg_title LIKE '%$search%' 
            OR blg_desc LIKE '%$search%' 
            OR blg_cont LIKE '%$search%' 
            OR blg_author LIKE '%$search%'";

    $result = mysqli_query($connection, $sql);
    $total = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/blogSearchResultPage.css">
</head>
<body>
    <div class="back-nav">
        <button onclick="history.back();">
          <img src="https://cdn-icons-png.flaticon.com/128/130/130882.png" alt="">
          <h3>Back to Blog Page</h3>
        </button>
    </div>

    <div class="main">
        <h1>Search results for "<?= htmlspecialchars($search) ?>"</h1>
        <h2><?= $total ?> Results Found</h2>

        <div class="results-grid">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="result-card">
                    <img src="<?php echo $row['blg_img']?>" alt="<?= htmlspecialchars($row['blg_title']) ?>" onerror="this.onerror=null; this.src='./img/placeholder-pic.jpg'">
                    <h3><?= htmlspecialchars($row['blg_title']) ?></h3>
                    <form action="blogContentPage.php" method="GET">
                        <input type="hidden" name="blg_ID" value="<?= htmlspecialchars($row['blg_ID']) ?>">
                        <button class="view-btn"  type="submit">View</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

<?php include 'footer.php'; ?>
</body>
</html>
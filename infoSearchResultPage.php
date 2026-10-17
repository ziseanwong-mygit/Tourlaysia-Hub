<!-- Programmer Name: Tei Yu Hong, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: infoSearchResultPage.php -->
<!-- Description: This page displays info site search results -->
<!-- Date first written: 1/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<?php
    include('./crud/db_connection.php');
    include('header.php');

    $search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

    $query = "SELECT * FROM info_site_t 
              WHERE ist_ID LIKE '%$search%' OR 
                    ist_title LIKE '%$search%' OR 
                    ist_desc LIKE '%$search%' OR 
                    ist_cont LIKE '%$search%' OR 
                    ist_type LIKE '%$search%' OR 
                    ist_author LIKE '%$search%'";

    $result = mysqli_query($connection, $query);
    $total = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/infoSearchResultPage.css">
</head>
<body>

<div class="back-nav">
    <button onclick="location.href='infoMainPage.php';">
        <img src="https://cdn-icons-png.flaticon.com/128/130/130882.png" alt="Back">
        <h3>Back to Info Site</h3>
    </button>
</div>

    <div class="main">
        <h1>Search results for "<?= htmlspecialchars($search) ?>"</h1>
        <h2><?= $total ?> Results Found</h2>

        <div class="results-grid">
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="result-card">
                    <img src="<?php echo $row['ist_img']?>" alt="<?= htmlspecialchars($row['ist_title']) ?>" onerror="this.onerror=null; this.src='./img/placeholder-pic.jpg'">
                    <div class="card-title"><h3><?= htmlspecialchars($row['ist_title']) ?></h3></div>
                    <p><?= htmlspecialchars($row['ist_desc']) ?></p>
                    <form action="infoContentPage.php" method="GET">
                        <input type="hidden" name="ist_ID" value="<?= htmlspecialchars($row['ist_ID']) ?>">
                        <button class="view-btn"  type="submit">View</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php include 'footer.php'; ?>
</body>
</html>
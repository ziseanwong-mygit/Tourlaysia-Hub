<!-- Programmer Name: Seath Tan Ziren
Project Name: infoMainPage.php
Description: To create info main page to allow users to find blogs and info about the destinations and travel agencies.
Date first written: 14/6/2025 
Date last modified: 26/6/2025  -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/blogMainPage.css">
</head>
<body>
    <?php 
        include 'header.php';
        include './crud/db_connection.php';
    ?>

    <div class="top">
        <div class="back-nav">
            <button onclick="location.href='home_page.php';"><img src="https://cdn-icons-png.flaticon.com/128/130/130882.png" alt=""><h3>Back to Home</h3></button>
        </div>

        <div class="search-bar">
            <form action="infoSearchResultPage.php" method="GET">
                <input type="text" name="search" placeholder="Search Info Page">
                <button><img src="https://cdn-icons-png.flaticon.com/128/954/954591.png" alt="" ></button>
            </form>
        </div>
    </div>

    <h2 class="title">Info Site</h2>

    <div class="latest">
        <h2>Latest Sites</h2>
        <div class="latest-container" >
            <div class="latest-item" >
                <?php
                    $query = "SELECT * FROM info_site_t ORDER BY ist_date_edit DESC LIMIT 5;";
                    $results = mysqli_query($connection, $query);
                    while ($data = mysqli_fetch_assoc($results)) {

                        $refSiteID = $data['ist_ID'];
                        $refSiteTitle = $data['ist_title'];
                        $refSiteDesc = $data['ist_desc'];
                        $refSiteImg = $data['ist_img'];

                ?>
                        <div class="grid-card" >
                            <img src="<?php echo $refSiteImg;?>" alt="<?php echo $refSiteTitle?>" onerror="this.onerror=null; this.src='./img/placeholder-pic.jpg'"> <p><strong><?php echo $refSiteTitle?></strong></p> <p><?php echo $refSiteDesc?></p>
                            <button onclick="location.href='infoContentPage.php?ist_ID=<?php echo $refSiteID?>';">View</button>
                        </div>
                <?php            
                        }
                ?>
            </div>
        </div>
    </div>

    <div class="all">
        <h2>All</h2>
        <div class="all-container">
            <div class="all-container-item">
                <?php
                    $query = "SELECT * FROM info_site_t ORDER BY ist_date_edit DESC LIMIT 100 OFFSET 5;";
                    $results = mysqli_query($connection, $query);
                    while ($data = mysqli_fetch_assoc($results)) {

                        $refSiteID = $data['ist_ID'];
                        $refSiteTitle = $data['ist_title'];
                        $refSiteDesc = $data['ist_desc'];
                        $refSiteImg = $data['ist_img'];
                ?>
                        <div class="grid-card" >
                            <img src="<?php echo $refSiteImg;?>" alt="<?php echo $refSiteTitle?>" onerror="this.onerror=null; this.src='./img/placeholder-pic.jpg'"> <p><strong><?php echo $refSiteTitle?></strong></p> <p><?php echo $refSiteDesc?></p>
                            <button onclick="location.href='infoContentPage.php?ist_ID=<?php echo $refSiteID?>';">View</button>
                        </div>
                <?php            
                    }
                ?>
            </div>
        </div>
    </div>

    <?php include 'footer.php';?>
</body>
</html>

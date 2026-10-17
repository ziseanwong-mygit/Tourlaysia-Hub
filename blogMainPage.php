<!-- Programmer Name: Seath Tan Ziren
Project Name: blogMainPage.php
Description: To create blog main page to allow users to find blogs and info about the destinations and travel agencies.
Date first written: 14/6/2025 
Date last modified: 26/6/2025   -->

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
            <form action="blogSearchResultPage.php" method="GET">
                <input type="text" name="search" placeholder="Search Blogs">
                <button><img src="https://cdn-icons-png.flaticon.com/128/954/954591.png" alt="" ></button>
            </form>
        </div>
    </div>

    <h2 class="title">Blog Page</h2>

    <div class="latest">
        <h2>Latest Blogs</h2>
        <div class="latest-container" >
            <div class="latest-item" >
                <?php
                    $query = "SELECT * FROM blog_t ORDER BY blg_date_edit DESC LIMIT 5;";
                    $results = mysqli_query($connection, $query);
                    while ($data = mysqli_fetch_assoc($results)) {

                        $refBlogID = $data['blg_ID'];
                        $refBlogTitle = $data['blg_title'];
                        $refBlogDesc = $data['blg_desc'];
                        $refBlogImg = $data['blg_img'];

                ?>
                        <div class="grid-card" >
                            <img src="<?php echo $refBlogImg;?>" alt="<?php echo $refBlogTitle?>" onerror="this.onerror=null; this.src='./img/placeholder-pic.jpg'"> <p><strong><?php echo $refBlogTitle?></strong></p> <p><?php echo $refBlogDesc?></p>
                            <button onclick="location.href='blogContentPage.php?blg_ID=<?php echo $refBlogID?>';">View</button>
                        </div>
                <?php            
                        }
                ?>
            </div>
        </div>
    </div>

    <div class="all">
        <h2>All Blogs</h2>
        <div class="all-container">
            <div class="all-container-item">
                <?php
                    $query = "SELECT * FROM blog_t ORDER BY blg_date_edit DESC LIMIT 100 OFFSET 5;";

                    $results = mysqli_query($connection, $query);

                    while ($data = mysqli_fetch_assoc($results)) {
                        $refBlogID = $data['blg_ID'];
                        $refBlogTitle = $data['blg_title'];
                        $refBlogDesc = $data['blg_desc'];
                        $refBlogImg = $data['blg_img'];
                ?>
                        <div class="grid-card" >
                            <img src="<?php echo $refBlogImg;?>" alt="<?php echo $refBlogTitle?>" onerror="this.onerror=null; this.src='./img/placeholder-pic.jpg'"></strong></p> <p><?php echo $refBlogDesc?></p>
                            <button onclick="location.href='blogContentPage.php?blg_ID=<?php echo $refBlogID?>';">View</button>
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



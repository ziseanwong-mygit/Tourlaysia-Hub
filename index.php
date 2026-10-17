<!-- Programmer Name: Seath Tan Ziren
Project Name: index.php
Description: To create index page.
Date first written: 14/6/2025 
Date last modified: 26/6/2025   -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./styles/index.css">
</head>
<body>
    <?php 
        include 'header.php';
        include './crud/db_connection.php';
    ?>

    <div class="banner">
        <img src="./img/Tourlaysia_banner.png" alt="">
        <div class="banner-slogan">
            <h1>Welcome to Tourlaysia - Gateway to My Journey</h1>
        </div>
    </div>

    <div class="option-container">
        <h3>
            Welcome to Tourlaysia! We provide you manifold of tour packages in the Malaysia tourism industry, ranging from West to East Malaysia areas. To make your reservation and enjoy your sweet holiday in Malaysia, it's simple! Just follow these three steps below:
        </h3>
        <div class="option-grid">
            <p class="option-button"><img src="https://cdn-icons-png.flaticon.com/128/1265/1265907.png" alt="">Search and Book tour</p>
            <p class="option-button"><img src="https://cdn-icons-png.flaticon.com/128/7603/7603006.png" alt="">Customise your Itinerary</p>
            <p class="option-button"><img src="https://cdn-icons-png.flaticon.com/128/1019/1019607.png" alt="">Make Payment</p>
        </div>
    </div>

    <h3 style="font-size:1.5rem;">What are you waiting for? Start Now!</h3>
    <div class="search-container">
        <div class="carousel-container">
            <div class="carousel-item active">
                <div class="carousel-item-content">
                    <button class="arrow" onclick="showPrevDiv(1)">◀</button>
                    <button onclick="location.href='package_results.php?searchWord=Kuala Lumpur';" class="city">Kuala Lumpur</button>
                    <button onclick="location.href='package_results.php?searchWord=Bintulu';" class="city">Bintulu</button>
                    <button onclick="location.href='package_results.php?searchWord=Miri';" class="city">Miri</button>
                    <button onclick="location.href='package_results.php?searchWord=Johor';" class="city">Johor</button>
                    <button onclick="location.href='package_results.php?searchWord=Penang';" class="city">Penang</button>
                    <button onclick="location.href='package_results.php?searchWord=Kelantan';" class="city">Kelantan</button>
                    <button onclick="location.href='package_results.php?searchWord=Tioman';" class="city">Tioman</button>
                    <button class="arrow" onclick="showNextDiv(1)">▶</button>
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-item-content">
                    <button class="arrow" onclick="showPrevDiv(1)">◀</button>
                    <button onclick="location.href='package_results.php?searchWord=Pangkor';" class="city">Pangkor</button>
                    <button onclick="location.href='package_results.php?searchWord=Redang';" class="city">Redang</button>
                    <button onclick="location.href='package_results.php?searchWord=Sipadan';" class="city">Sipadan</button>
                    <button onclick="location.href='package_results.php?searchWord=Tawau';" class="city">Tawau</button>
                    <button onclick="location.href='package_results.php?searchWord=Kota Kinabalu';" class="city">Kota Kinabalu</button>
                    <button onclick="location.href='package_results.php?searchWord=Kundasang';" class="city">Kundasang</button>
                    <button onclick="location.href='package_results.php?searchWord=Ipoh';" class="city">Ipoh</button>
                    <button class="arrow" onclick="showNextDiv(1)">▶</button>
                </div>
            </div>
        </div>

        <div class="search-bar">
            <form action="blogSearchResultPage.php" method="GET">
                <input type="text" name="search" placeholder="Search Blogs">
                <button class="search-btn">&#128269;</button>
            </form>
            <button onclick="location.href='blogMainPage.php';">More</button>
        </div>
    </div>

    <div class="register-login-container">
        <h3>Join Our Web</h3>
        <div class="register-login-box">
            <button onclick="location.href='registerTouristPage.php';"class="register-login-btn">
                <i class="ri-user-add-fill"></i>
                Register
            </button>
            <button onclick="location.href='touristLoginPage.php';" class="register-login-btn">
                <i class="ri-login-box-fill"></i>
                Login
            </button>
        </div>
    </div>

    <h3>Images</h3>
    <div class="slideshow-container">
        <div class="carousel-container">
            <?php
            $query = "SELECT * FROM tour_package_t ORDER BY pkg_title;";
            $result = mysqli_query($connection, $query);
            $index = 0;

            while ($data = mysqli_fetch_assoc($result)) {
                $refPkgID = $data['pkg_ID'];
                $refPkgTitle = $data['pkg_title'];
                $refPkgImg = $data['pkg_img'];
                $images = array_slice(explode(',', $refPkgImg), 0, 3); // get first 3 images
            ?>
                <div class="carousel-item <?php if ($index === 0) echo 'active'; ?>">
                    <div class="carousel-item-content">
                        <button class="arrow" onclick="showPrevDiv(2)">◀</button>

                        <div class="grid-card">
                            <h4><?php echo $refPkgTitle; ?></h4>
                            <div class="grid-card-images-box">
                                <?php foreach ($images as $img): ?>
                                    <img src="./img/package/<?php echo trim($img); ?>" alt="image">
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <button class="arrow" onclick="showNextDiv(2)">▶</button>
                    </div>
                </div>
            <?php
                $index++;
            }
        ?>
        </div>
    </div>

    <?php include 'footer.php';?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        let currentIndex1 = 0;
        let currentIndex2 = 0;

        // Select all carousel items for each carousel
        const items1 = document.querySelectorAll(".search-container .carousel-item");
        const items2 = document.querySelectorAll(".slideshow-container .carousel-item");
        console.log(items1);

        // Function to show the next item in the carousel
        window.showNextDiv = function(carouselNumber) {
            let items, currentIndex;

            // Select the appropriate items and index based on carouselNumber
            if (carouselNumber === 1) {
                items = items1;
                currentIndex = currentIndex1;
                console.log("Current Index: " + currentIndex);
            } else if (carouselNumber === 2) {
                items = items2;
                currentIndex = currentIndex2;
            }

            // Check if items are available
            if (items.length > 0) {
                // Hide the current item
                items[currentIndex].classList.remove("active");

                // Update the current index
                currentIndex = (currentIndex + 1) % items.length;

                // Show the next item
                items[currentIndex].classList.add("active");

                // Update the index for the respective carousel
                if (carouselNumber === 1) {
                    currentIndex1 = currentIndex;
                } else if (carouselNumber === 2) {
                    currentIndex2 = currentIndex;
                }
            }
        };

        // Function to show the previous item in the carousel
        window.showPrevDiv = function(carouselNumber) {
            let items, currentIndex;

            // Select the appropriate items and index based on carouselNumber
            if (carouselNumber === 1) {
                items = items1;
                currentIndex = currentIndex1;
            } else if (carouselNumber === 2) {
                items = items2;
                currentIndex = currentIndex2;
            }

            // Check if items are available
            if (items.length > 0) {
                // Hide the current item
                items[currentIndex].classList.remove("active");

                // Update the current index
                currentIndex = (currentIndex - 1 + items.length) % items.length;

                // Show the previous item
                items[currentIndex].classList.add("active");

                // Update the index for the respective carousel
                if (carouselNumber === 1) {
                    currentIndex1 = currentIndex;
                } else if (carouselNumber === 2) {
                    currentIndex2 = currentIndex;
                }
            }
        };
    });
    </script>
</body>
</html>



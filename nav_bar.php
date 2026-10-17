<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: search_bar.php -->
<!-- Description: To create a search bar for users to search tour packages. -->
<!-- Date first written: 27/6/2025 -->
<!-- Date last modified: 28/6/2025 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css">
    <link rel="stylesheet" href="./styles/styles.css">
    <link rel="stylesheet" href="./styles/nav_bar.css">
</head>
<body>
    <!-- Top navigation bar starts here -->
    <div class="navbar-top" id="myNavBar">
        <div class="dropdown">
            <button class="dropdown-button">
                Destination 
                <i class="ri-arrow-down-s-fill"></i>
            </button>
            <div class="dropdown-content">
                <b>West Malaysia</b>
                <a href="package_results.php?filterWord=KLCC">KLCC</a>
                <a href="package_results.php?filterWord=Genting Highland">Genting Highland</a>
                <a href="package_results.php?filterWord=Cameron Highlands">Cameron Highlands</a>
                <a href="package_results.php?filterWord=Bukit Bintang">Bukit Bintang</a>
                <a href="package_results.php?filterWord=Pulau Redang">Pulau Redang</a>
                <a href="package_results.php?filterWord=Pulau Tioman">Pulau Tioman</a>
                <b>East Malaysia</b>
                <a href="package_results.php?filterWord=Gua Niah">Gua Niah</a>
                <a href="package_results.php?filterWord=Gunung Mulu">Gunung Mulu</a>
                <a href="package_results.php?filterWord=Bako National Park">Bako National Park</a>
                <a href="package_results.php?filterWord=Mount Kinabalu">Mount Kinabalu</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropdown-button">
                Cities/Districts 
                <i class="ri-arrow-down-s-fill"></i>
            </button>
            <div class="dropdown-content">
                <b>West Malaysia</b>
                <a href="package_results.php?filterWord=Kuala Lumpur">Kuala Lumpur</a>
                <a href="package_results.php?filterWord=Ipoh">Ipoh</a>
                <a href="package_results.php?filterWord=George Town">George Town</a>
                <a href="package_results.php?filterWord=Malacca City">Malacca City</a>
                <a href="package_results.php?filterWord=Johor Bahru">Johor Bahru</a>
                <b>East Malaysia</b>
                <a href="package_results.php?filterWord=Kuching">Kuching</a>
                <a href="package_results.php?filterWord=Kota Kinabalu">Kota Kinabalu</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropdown-button">
                States/WP 
                <i class="ri-arrow-down-s-fill"></i>
            </button>
            <div class="dropdown-content">
                <b>West Malaysia</b>
                <a href="package_results.php?filterWord=Johor">Johor</a>
                <a href="package_results.php?filterWord=Kedah">Kedah</a>
                <a href="package_results.php?filterWord=Kelantan">Kelantan</a>
                <a href="package_results.php?filterWord=Melaka">Melaka</a>
                <a href="package_results.php?filterWord=Pahang">Pahang</a>
                <a href="package_results.php?filterWord=Penang">Penang</a>
                <a href="package_results.php?filterWord=Perak">Perak</a>
                <a href="package_results.php?filterWord=Perlis">Perlis</a>
                <a href="package_results.php?filterWord=Selangor">Selangor</a>                
                <a href="package_results.php?filterWord=Terengganu">Terengganu</a>
                <a href="package_results.php?filterWord=Kuala Lumpur">Kuala Lumpur</a>
                <a href="package_results.php?filterWord=Putrajaya">Putrajaya</a>
                <b>East Malaysia</b>
                <a href="package_results.php?filterWord=Sarawak">Sarawak</a>
                <a href="package_results.php?filterWord=Sabah">Sabah</a>
                <a href="package_results.php?filterWord=Labuan">Labuan</a>
            </div>
        </div>

        <a href="javascript:void(0);" style="font-size:25px;" class="icon" onclick="myFunction()">
            <i class="ri-menu-unfold-line"></i>
        </a>

        <!-- Search bar design 1 -->
        <div class="searchbar-container">
            <form action="package_results.php?searchWord=$_GET['searchWord']" method="GET" class="searchbar">
                <input type="search" placeholder="Search your package..." name="searchWord" required>
                <button type="submit" class="searchbtn" title="Search now!"><i class="ri-search-2-line "></i></button>
            </form>
        </div>

        <!-- Search bar design 2 -->
        <div class="searchbar-container2">
            <form action="package_results.php?searchWord=$_GET['searchWord']" method="GET" class="searchbar2">
                <input type="search" placeholder="Search your package..." name="searchWord" required>
                <button type="submit" class="searchbtn2" title="Search now!"><i class="ri-search-2-line "></i></button>
            </form>
            <i class="ri-search-2-line searchicon2" id="searchIcon2"></i>
        </div>
    </div>

    <script>
        // JavaScript for responsive nav bar; when icon is clicked, the class name "responsive" is added to each element
        function myFunction() {
            var x = document.getElementById("myNavBar");
            if (x.className === "navbar-top") {
                x.className += " responsive";
            } else {
                x.className = "navbar-top";
            }
        }

        // JavaScript for search bar design 2; when icon is clicked, the icon design changes accordingly
        const nav = document.querySelector(".navbar-top");
        searchIcon2 = document.querySelector("#searchIcon2");

        searchIcon2.addEventListener("click", () => {
            nav.classList.toggle("openSearch");
            if(nav.classList.contains("openSearch")) {
                return searchIcon2.classList.replace("ri-search-2-line", "ri-close-line");
            }
            searchIcon2.classList.replace("ri-close-line", "ri-search-2-line")
        });
    </script>
</body>
</html>
<!-- Programmer Name: Vun Jin Quan, Group Member of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: package_info.php -->
<!-- Description: Allow traveller to view information of the trip, tour plan and gallery -->
<!-- Date first written: 26/6/2025 -->
<!-- Date last modified: 29/6/2025 -->

<?php
require './crud/db_connection.php';

// Get pkg_ID from GET or use session value
if (isset($_GET['pkgID'])) {
    $_SESSION['pkgID'] = $_GET['pkgID'];
} elseif (!isset($_SESSION['pkgID'])) {
    die("No package ID provided.");
}

$pkg_ID = $_SESSION['pkgID'];

?>
<?php
$query = "SELECT * FROM tour_package_t WHERE pkg_ID = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "s", $pkg_ID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    // Successfully found package
    $pkgImgList = $row['pkg_img'];
    $imgList = explode(',', $pkgImgList);
} else {
    die("No package found with ID: $pkg_ID");
}
?>

<?php
$tour_plan_query = "
    SELECT * FROM pkg_item_list_t 
    WHERE pkg_ID = ? 
    ORDER BY pkg_day, pkg_act_seqNo ASC";

$tour_plan_stmt = mysqli_prepare($connection, $tour_plan_query);
mysqli_stmt_bind_param($tour_plan_stmt, "s", $pkg_ID);
mysqli_stmt_execute($tour_plan_stmt);
$tour_plan_result = mysqli_stmt_get_result($tour_plan_stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="./img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.css ">
    <link rel="stylesheet" href="./styles/styles_Package.css">
</head>
<body>
<?php?>

<?php include 'header.php';?>
<?php include 'nav_bar.php';?>

<!-- Main Content -->
<main class="content-container">
    <section class="card">
        <!-- Tabs -->
        <div class="tabs-inside-card">
            <button class="tab-button active" onclick="switchTab(event, 'info')"><i class="ri-information-fill"></i> Information</button>
            <button class="tab-button" onclick="switchTab(event, 'tour-plan')"><i class="ri-briefcase-4-fill"></i> Tour Plan</button>
            <button class="tab-button" onclick="switchTab(event, 'gallery')"><i class="ri-image-fill"></i> Gallery</button>
        </div>

        <!-- Tab: Information -->
        <div class="tab-content" id="info">
            <h2 class="package-title"><?= htmlspecialchars($row['pkg_dest']) ?> <span class="price">RM <?= htmlspecialchars($row['pkg_price']) ?></span><span class="pax"> / Per Pax</span></h2>
            <p class="description"><?= htmlspecialchars($row['pkg_desc']) ?></p>
            <table class="package-details">
                <tr><td><strong>Travel Duration:</strong></td><td><?= htmlspecialchars($row['trv_dura']) ?></td></tr>
                <tr><td><strong>Travel Period:</strong></td><td><?= htmlspecialchars($row['trv_period']) ?></td></tr>
                <tr><td><strong>Package Room:</strong></td><td><?= htmlspecialchars($row['pkg_room']) ?></td></tr>
                <tr><td><strong>Transportation:</strong></td><td><?= htmlspecialchars($row['pkg_transp']) ?></td></tr>
                <tr><td><strong>Activity:</strong></td><td><?= htmlspecialchars($row['pkg_act']) ?></td></tr>
                <tr><td><strong>Perks:</strong></td><td><?= htmlspecialchars($row['pkg_perks']) ?></td></tr>
            </table>
        </div>

        <!-- Tab: Tour Plan -->
        <div class="tab-content" id="tour-plan" style="display:none;">
            <?php
            $current_day = '';
            while ($item = mysqli_fetch_assoc($tour_plan_result)) {
                if ($item['pkg_day'] !== $current_day) {
                    if ($current_day !== '') echo '</ul>';
                    echo "<h3>{$item['pkg_day']} - {$item['pkg_date']}</h3>";
                    echo "<ul>";
                    $current_day = $item['pkg_day'];
                }
                echo "<li>{$item['pkg_act']}</li>";
            }
            if ($current_day !== '') echo '</ul>';
            ?>
        </div>

        <!-- Tab: Gallery -->
        <div class="tab-content" id="gallery" style="display:none;">
            <div class="image-grid fade" id="gallery-grid"></div>
            <div class="pagination-wrapper" id="pagination"></div>
        </div>

    <?php
        if (isset($_SESSION['SES_UserID'])) {
    ?>
            <!-- Book Now Button -->
            <div class="book-button-wrapper">
                <button class="book-now-btn" onclick="document.location='bookingFormPage1.php?pkgID=<?php echo $pkg_ID?>';">Book now</button>
            </div>
    <?php
        } else {
    ?>
            <div class="book-button-wrapper">
                <button class="book-now-btn" onclick="document.location='touristLoginPage.php';">Login to book tour</button>
            </div>
    <?php
        }
    ?>
    </section>
</main>

<?php include 'footer.php';?>

<!-- Modal -->
<div id="imgModal" class="modal">
    <span class="closeBtn" onclick="closeModal()">&times;</span>
    <div class="zoom-controls">
        <button onclick="zoomIn()">＋</button>
        <button onclick="zoomOut()">－</button>
    </div>
    <div class="modal-img-wrapper">
        <img class="modal-content" id="modalImage">
    </div>
</div>

<!-- Scripts -->
<script>
    const images = <?= json_encode(array_map('trim', explode(',', $row['pkg_img']))) ?>;
    const pageSize = 6;
    let currentGalleryPage = 1;

    function renderGalleryPage(page) {
        const grid = document.getElementById('gallery-grid');
        const pagination = document.getElementById('pagination');
        const totalPages = Math.ceil(images.length / pageSize);

        if (page < 1) page = 1;
        if (page > totalPages) page = totalPages;
        currentGalleryPage = page;

        grid.classList.remove('show');
        setTimeout(() => {
            const start = (page - 1) * pageSize;
            const currentImages = images.slice(start, start + pageSize);
            grid.innerHTML = '';
            currentImages.forEach(src => {
                const box = document.createElement('div');
                box.classList.add('image-box');
                box.innerHTML = `<img src="./img/package/${src}" alt="Gallery Image" onclick="openModal('./img/package/${src}')">`;
                grid.appendChild(box);
            });
            grid.classList.add('show');
        }, 200);

        pagination.innerHTML = '';
        pagination.style.display = totalPages > 1 ? 'block' : 'none';

        const prevBtn = document.createElement('button');
        prevBtn.classList.add('nav');
        prevBtn.innerHTML = '<';
        prevBtn.onclick = () => renderGalleryPage(currentGalleryPage - 1);
        prevBtn.disabled = (currentGalleryPage === 1);
        pagination.appendChild(prevBtn);

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            if (i === page) btn.classList.add('active');
            btn.onclick = () => renderGalleryPage(i);
            pagination.appendChild(btn);
        }

        const nextBtn = document.createElement('button');
        nextBtn.classList.add('nav');
        nextBtn.innerHTML = '>';
        nextBtn.onclick = () => renderGalleryPage(currentGalleryPage + 1);
        nextBtn.disabled = (currentGalleryPage === totalPages);
        pagination.appendChild(nextBtn);
    }

    function switchTab(event, tabId) {
        document.querySelectorAll('.tab-content').forEach(tab => tab.style.display = 'none');
        document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
        document.getElementById(tabId).style.display = 'block';
        event.currentTarget.classList.add('active');

        if (tabId === 'gallery') {
            renderGalleryPage(currentGalleryPage);
        } else {
            document.getElementById('pagination').style.display = 'none';
        }
    }

    let zoomLevel = 1;
    function openModal(src) {
        const modalImg = document.getElementById('modalImage');
        modalImg.src = src;
        zoomLevel = 1;
        modalImg.style.transform = `scale(${zoomLevel})`;
        document.getElementById('imgModal').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('imgModal').classList.remove('show');
        document.body.style.overflow = '';
    }

    function zoomIn() {
        zoomLevel += 0.1;
        document.getElementById('modalImage').style.transform = `scale(${zoomLevel})`;
    }

    function zoomOut() {
        zoomLevel = Math.max(0.1, zoomLevel - 0.1);
        document.getElementById('modalImage').style.transform = `scale(${zoomLevel})`;
    }

    function openNav() {
        document.getElementById("jsNavMenu").style.width = "250px";
    }

    function closeNav() {
        document.getElementById("jsNavMenu").style.width = "0";
    }
</script>

</body>
</html>
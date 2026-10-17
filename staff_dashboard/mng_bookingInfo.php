<!-- Programmer Name: Wong Zi Sean, Group Leader of Peaky Blinders, AAPP011-4-2 Capstone Project -->
<!-- Project Name: mng_bookingInfo.php -->
<!-- Description: To create a manage booking record info panel that shows booking details and edit/delete buttons-->
<!-- Date first written: 13/7/2025 -->
<!-- Date last modified: 13/7/2025 -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourlaysia - Your Malaysia Travel Hub</title>
    <link rel="icon" type="image/png" href="../img/logo/Tourlaysia_Favicon32.png">
    <link rel="stylesheet" href="./staff_styles/staff_styles.css">
    <link rel="stylesheet" href="./staff_styles/mng_recInfo.css">
</head>
<body>
    <?php include 'staff_header.php';?>

    <?php
        // Connect database
        include './staff_crud/db_connection.php';

        // Retrieve original values from table
        $bookingIDRef = $_GET['bookID'];
        $queryA = "SELECT * FROM tour_booking_t WHERE bkn_ID = '$bookingIDRef';";
        $resultsA = mysqli_query($connection, $queryA);
        $dataA = mysqli_fetch_assoc($resultsA);

        $pkgID = $dataA['pkg_ID'];
        $pkgDest = $dataA['pkg_dest'];
        $usrID = $dataA['usr_ID'];
        $usrDocID = $dataA['usr_doc_ID'];
        $usrName = $dataA['usr_name'];
        $usrEmail = $dataA['usr_email'];
        $usrNoTel = $dataA['usr_no_tel'];
        $bknTitle = $dataA['bkn_title'];
        $bknDesc = $dataA['bkn_desc'];
        $bknDate = $dataA['bkn_date'];
        $numPax = $dataA['num_pax'];
        $bknRemark = $dataA['bkn_remark'];
        $bknStatus = $dataA['bkn_status'];
    ?>
        <div class="mng-rec-title-div">
            <h2 class="mng-rec-title">Manage Booking - View, Edit / Delete Record</h2>
        </div>
        <main class="mng-rec-main-div">
            <div class="mng-rec-heading-div">
                <h3 class="mng-rec-heading">General Info</h3>
            </div>
            <div class="mng-rec-info-div">
                <div class="info-div">
                    <p><b>Booking ID: </b><?php echo $bookingIDRef;?></p>
                    <p><b>Package ID: </b><?php echo $pkgID;?></p>
                    <p><b>Package Destination: </b><?php echo $pkgDest;?></p>
                    <p><b>Booker ID: </b><?php echo $usrID;?></p>
                    <p><b>Booker Doc ID: </b><?php echo $usrDocID;?></p>
                    <p><b>Booker Name: </b><?php echo $usrName;?></p>
                    <p><b>Booker Email: </b><?php echo $usrEmail;?></p>
                    <p><b>Booker No. Tel: </b><?php echo $usrNoTel;?></p>
                </div>
            </div>
        </main>

        <main class="mng-rec-main-div">
            <div class="mng-rec-heading-div">
                <h3 class="mng-rec-heading">Booking Info</h3>
            </div>
            <div class="mng-rec-info-div">
                <div class="info-div">
                    <p><b>Booking Title: </b> <?php echo $bknTitle;?></p>
                    <p><b>Booking Date: </b><?php echo $bknDate;?></p>
                    <p><b>Booking Desc: </b><?php echo $bknDesc;?></p>
                    <p><b>Pax Number: </b><?php echo $numPax;?></p>
                    <p><b>Remarks: </b><?php echo $bknRemark;?></p>
                    <p><b>Status: </b><?php echo $bknStatus;?></p>
                </div>
            </div>
            <div class="mng-rec-btn-div">
                <button class="editBtn" onclick="document.location='./edit_bookingRec.php?bookID=<?php echo $bookingIDRef;?>';">
                    <i class="ri-edit-2-fill"></i>
                    Edit
                </button>
                <!-- The button will trigger a popup box to alert for deletion -->
                <button class="delBtn" onclick="document.getElementById('delPopup2').style.display='block'">
                    <i class="ri-delete-bin-2-fill"></i>
                    Delete
                </button>
                <button class="otherBtn" onclick="document.location='manageBooking.php';">
                    <i class="ri-arrow-left-line"></i>
                    Back
                </button>
            </div>
        </main>

        <main class="mng-rec-main-div">
            <div class="mng-rec-heading-div">
                <h3 class="mng-rec-heading">Booking Member List Info</h3>
            </div>
            <div class="table-info-div">
                <table class="table-info">
                    <tr class="table-info-row">
                        <th class="table-info-header">Member Doc ID</th>
                        <th class="table-info-header">Member Name</th>
                        <th class="table-info-header">Actions</th>
                    </tr>
                    <?php
                        $queryB = "SELECT * FROM book_mbr_list_t WHERE bkn_ID = '$bookingIDRef' ORDER BY mbr_seqNo ASC;";
                        $resultsB = mysqli_query($connection, $queryB);
                        while($dataB = mysqli_fetch_assoc($resultsB)) {
                            $mbrListIDRef = $dataB['mbr_ls_ID'];
                    ?>
                            <tr class="table-info-row">
                                <td class="table-info-data"><?php echo $dataB['mbr_doc_ID'];?></td>
                                <td class="table-info-data"><?php echo $dataB['mbr_name'];?></td>
                                <td class="table-info-data action-btn">
                                    <button class="editBtn" onclick="document.location='./edit_bookMemberRec.php?mbrListID=<?php echo $mbrListIDRef?>';" style="margin-bottom:15px;">
                                        <i class="ri-edit-2-fill"></i>
                                        Edit
                                    </button>
                                    <!-- The button will trigger a popup box to alert for deletion -->
                                    <form method="POST" onsubmit="return confirm('Are you sure you want to delete this record? This action cannot be undone.');">
                                        <input type="hidden" name="mbrListID" value="<?php echo $mbrListIDRef; ?>">
                                        <button class="delBtn" type="submit" name="deleteTourMember">
                                            <i class="ri-delete-bin-2-fill"></i>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
            <div class="mng-rec-btn-div table-rec-btn">
                <button class="editBtn" onclick="document.location='./add_bookMemberRec.php?bookID=<?php echo $bookingIDRef;?>';">
                    <i class="ri-add-box-fill"></i>
                    Add Member
                </button>
            </div>
        </main>

        <!--
        <div id="delPopup3" class="popupBox">
            <i onclick="document.getElementById('delPopup3').style.display='none'" class="ri-close-large-fill closeIcon"></i>
            <form action="" method="POST" class="popup-form" >
                <div class="popup-form-div">
                    <h1>Delete Tour Member Record</h1>
                    <p>Are you sure you want to delete this member from the booking? <span>Action cannot be undone.</span></p>
                
                    <div class="clearfix">
                        <input type="hidden" name="mbrListIDRef" id="deleteRefRec" value="">
                        <input type="button" onclick="document.getElementById('delPopup3').style.display='none'" class="cancelbtn" value="Cancel">
                        <input type="submit" name="deleteTourMember" onclick="document.getElementById('delPopup3').style.display='none'" class="deletebtn" value="Delete">
                    </div>
                </div>
            </form>
        </div>
        -->

        <div id="delPopup2" class="popupBox">
            <i onclick="document.getElementById('delPopup2').style.display='none'" class="ri-close-large-fill closeIcon"></i>
            <form action="" method="POST" class="popup-form" >
                <div class="popup-form-div">
                    <h1>Delete Booking Record</h1>
                    <p>Are you sure you want to delete this booking? <span>Action cannot be undone.</span></p>
                
                    <div class="clearfix">
                        <input type="button" onclick="document.getElementById('delPopup2').style.display='none'" class="cancelbtn" value="Cancel">
                        <input type="submit" name="deleteBookingRec" onclick="document.getElementById('delPopup2').style.display='none'" class="deletebtn" value="Delete">
                    </div>
                </div>
            </form>
        </div>

    <?php include 'staff_footer.php';?>

    <?php
        if (isset($_POST['deleteTourMember'])) {
            include './staff_crud/deleteTourMember.php';
        }

        if (isset($_POST['deleteBookingRec'])) {
            include './staff_crud/deleteBooking.php';
        }
    ?>
</body>
</html>
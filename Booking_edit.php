<?php
session_start();
include "Database_connection.php";

if(isset($_POST['submit']))
{
    // Insert    
    $BID=$_POST['booking_id'];
    //echo $BID;
    $CID=$_POST['booking_cid'];
    $COD=$_POST['booking_cod'];
    $BOOKINGNO=$_POST['no_booking'];
    $RID=$_POST['room_id'];
    $sql=" UPDATE booking SET booking_cid='$CID', booking_cod='$COD', no_booking='$BOOKINGNO', room_id='$RID' WHERE booking_id='$BID'";
    
    if(!mysqli_query($conn,$sql)){
        echo'<script>alert("Not Inserted")</script>';
        echo'<script>window.location="http://localhost/hotel/Booking_edit.php"</script>';
    }
    else
        header("location: http://localhost/hotel/Booking_list.php");
}

elseif(isset($_GET['id'])){
    $BID=$_GET['id'];
    $SQL= "SELECT * FROM booking WHERE booking_id='$BID' ";
    $result = mysqli_query($conn, $SQL);
    if(mysqli_num_rows($result)>0)
    {
        while ($row = $result->fetch_assoc()){
            $BID=$row["booking_id"];
            $CID=$row["booking_cid"];
            $COD=$row["booking_cod"];
            $BOOKINGNO=$row["no_booking"];
            $RID=$row["room_id"];
        }
    }
    else{
        echo "Try Again";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ashton Hotel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
        @font-face {
            font-family: myFont;
            src: url('jak.woff');
        }

        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background: radial-gradient(circle, rgba(60,51,94,1) 30%, rgba(134,87,79,1) 100%);
            background-size: cover;
            color: #333; /* Dark text color */
        }

        /* Header styles */
        .header {
            padding: 5px;
            text-align: center;
            background-color: black;
            opacity: 0.9;
        }
        .header img {
            width: 100%;
            height: auto;
        }

        /* Navigation bar styles */
        .topnav {
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.5); /* Translucent black background */
            font-family: 'Montserrat', sans-serif;
        }
        .topnav a {
            display: inline-block; /* Changed from float: left; */
            color: white;
            text-align: center;
            padding: 20px 30px;
            text-decoration: none;
        }
        .topnav a:hover {
            background-color: #9f6060;
        }
        .topnav a img {
            height: 18px; /* Adjust this value as needed */
            vertical-align: middle;
        }

        /* Content Container */
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
        }

        .table-container {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 10px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
            color: black; /* Adjusted text color */
            font-size: 20px; /* Matching font size */
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Buttons */
        .dropbtn {
            padding: 8px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            color: white;
            background-color: #007bff; /* Blue color for primary button */
        }

        .dropbtn:hover {
            background-color: #0056b3; /* Darker blue color on hover */
        }

        .edit-btn {
            background-color: #28a745; /* Green color for edit button */
        }

        .delete-btn {
            background-color: #dc3545; /* Red color for delete button */
        }

        .dropbtn, .edit-btn, .delete-btn {
            margin-bottom: 5px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .topnav a {
                padding: 15px 10px;
            }
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <div class="header">
        <img src="header.jpg" alt="Ashton Logo">
    </div>
<!-- Navigation Bar -->
<div class="topnav">
<a href="adminnav.php"><img src="home-icon.png" id="home-icon" alt="Home Icon"></a>
<a href="Room_list.php">ROOM DETAILS</a>
    <a href="Admin_list.php">ADMIN DETAILS</a>
    <a href="Booking_list.php">BOOKING DETAILS</a>
    <a href="sales_report.php">REPORT</a>
    <audio id="background-audio" src="song.mp3"></audio>
    <img src="audio-icon.png" style="float: right; margin: 10px; cursor: pointer;" class="audio-icon" id="audio-icon" alt="Audio Icon" width="32" height="32">
    <a style="float:right" href="logout.php">LOGOUT</a>
    <a style="float:right" href="http://localhost/hotel/adminnav.php" class="previous">&laquo; Previous</a>
    <a style="float:right" href="http://localhost/hotel/Room_list.php" class="next">Next &raquo;</a>
</div>


    <!-- Main Content -->
    <div class="container">

        <h1  class="text-center">BOOKING EDIT FORM</h1>

        <div align="center">
            <form name="Booking_edit" method="post" action="http://localhost/hotel/Booking_edit.php">
                <input type="hidden" name="booking_id" value="<?php echo $BID ?>" />

                <table>
                    <tr>
                        <td><label>Check in Date</label></td>
                        <td><input type="date" name="booking_cid" value="<?php echo $CID ?>" required></td>
                    </tr>
                    <tr>
                        <td><label>Check Out Date</label></td>
                        <td><input type="date" name="booking_cod" value="<?php echo $COD ?>" required></td>
                    </tr>
                    <tr>
                        <td><label>Booking No</label></td>
                        <td><input type="number" name="no_booking" value="<?php echo $BOOKINGNO ?>" required></td>
                    </tr>
                    <tr>
                        <td><label>Room ID</label></td>
                        <td><input type="number" name="room_id" value="<?php echo $RID ?>" required></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">
                            <input type="reset" value="Reset">
                            <input type="submit" name="submit" value="Submit">
                        </td>
                    </tr>
                </table>
            </form>
        </div>

    </div>

</body>

</html>

<?php
session_start();
include "Database_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashton Hotel - Booking List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
    <a style="float:right" href="http://localhost/hotel/Booking_list_display.php" class="next">Next &raquo;</a>
</div>

<!-- Main Content -->
<div class="container">

    <div>
        <h1 class="text-center">BOOKING LIST</h1>
    </div>

    <!-- Booking List Table -->
    <div class="table-container">
        <table class="table table-hover">
            <thead>
                <tr style="color:black; font-size: 20px; text-align:center;">
                    <th>Booking ID</th>
                    <th>CID</th>
                    <th>COD</th>
                    <th>Booking No.</th>
                    <th>Room ID</th>
                </tr>
            </thead>
            <tbody style="color:black">
                <?php
                $sql = "SELECT * FROM booking ";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["booking_id"]; ?></td>
                    <td><?php echo $row["booking_cid"]; ?></td>
                    <td><?php echo $row["booking_cod"]; ?></td>
                    <td><?php echo $row["no_booking"]; ?></td>
                    <td><?php echo $row["room_id"]; ?></td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='5'>No bookings found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

<!-- Include audio control if needed -->
<?php include "audio_control.php"; ?>

</body>
</html>

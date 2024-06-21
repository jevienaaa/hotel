<?php
session_start();
include "Database_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashton Hotel - Room List</title>
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
        .flip-box {
            background-color: transparent;
            color: white;
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            perspective: 1000px;
            animation: fadeIn 2s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .flip-box-inner {
            position: relative;
            width: 100%;
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }

        .flip-box:hover .flip-box-inner {
            transform: rotateY(180deg);
        }

        .flip-box-front, .flip-box-back {
            position: absolute;
            width: 100%;
            backface-visibility: hidden;
            font-family: myFont;
            color: white;
        }

        .flip-box-back {
            transform: rotateY(180deg);
        }

        h1 {
            font-size: 50px;
            /* font-weight: bold; */
        }

        @media (max-width: 767px) {
            .topnav a {
                display: block;
                text-align: center;
            }
            .audio-icon {
                float: right;
                margin: 10px;
                cursor: pointer;
            }
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
    <a style="float:right" href="http://localhost/hotel/Admin_list.php" class="next">Next &raquo;</a>
</div>

<!-- Main Content -->
<div class="container">

    <div>
        <h1 class="text-center">ROOM LIST</h1>
    </div>

    <!-- Room List Table -->
    <div class="table-container">
        <table class="table table-hover">
            <thead>
                <tr style="color:black; font-size: 20px; text-align:center;">
                    <th>Room Name</th>
                    <th>Room</th>
                    <th>Room Location</th>
                    <th>Room Availability</th>
                    <th>Price(RM)</th>
                    <th>Rating</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody style="color:black">
                <?php
                $sql = "SELECT * FROM room";
                $result = mysqli_query($conn, $sql);
                if(mysqli_num_rows($result) > 0) {
                    while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row["room_name"]; ?></td>
                    <td><img src="Image/<?php echo $row["room_image"]; ?>" width="150px" height="160px"></td>
                    <td><?php echo $row["room_location"]; ?></td>
                    <td><?php echo $row["room_availability"]; ?></td>
                    <td><?php echo $row["room_price"]; ?></td>
                    <td><?php echo $row["room_rating"]; ?></td>
                    <td><?php echo $row["room_description"]; ?></td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='9'>No rooms found</td></tr>";
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

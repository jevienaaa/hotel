<?php
session_start();
include "Database_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashton Hotel - Admin List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
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
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
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
        <h1 class="text-center">ADMIN LIST</h1>
    </div>
   <!-- Room List Table -->
   <div class="table-container">
   <table style="overflow-x:auto;" class="table table-hover">
    <thead>
      <tr style="color:black; font-size: 20px; text-align:center;">
        <th>Admin ID</th>
        <th>Name</th>
        <th>Password</th>
   
      </tr> 

      <tbody style="color:black">
    <?php

      $sql="SELECT * FROM owner ";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result)>0)
      {
        while ($row = $result->fetch_assoc())
        {
      ?>
    
      <tr>
        <td><h4 class="text"><?php echo $row["owner_id"]; ?></h4></td>
        <td><h4 class="text"><?php echo $row["owner_name"]; ?></h4></td>
        <td><h4 class="password"><?php echo $row["owner_password"]; ?></h4></td>
      </tr>
      <?php
      }
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

<?php
session_start();
include "Database_connection.php";

if(isset($_POST['submit']))
{
    // Update query
    $RID = $_POST['room_id'];
    $NAME2 = $_POST['room_name'];
    $AVAILABILITY2 = $_POST['room_availability'];
    $PRICE2 = $_POST['room_price'];
    $RATE2 = $_POST['room_rating'];
    $DESC2 = $_POST['room_description'];
    $LOCATION2 = $_POST['room_location'];
    $sql = "UPDATE room SET room_name='$NAME2', room_availability='$AVAILABILITY2', room_price='$PRICE2', room_rating='$RATE2', room_description='$DESC2', room_location='$LOCATION2' WHERE room_id='$RID'";
    
    if(!mysqli_query($conn, $sql)) {
        echo '<script>alert("Not Inserted")</script>';
        echo '<script>window.location="http://localhost/hotel/Room_edit_form.php"</script>';
    } else {
        header("location: http://localhost/hotel/Room_list.php");
        exit();
    }
}

elseif(isset($_GET['id'])) {
    // Fetch room details for editing
    $OID = $_GET['id'];
    $SQL = "SELECT * FROM room WHERE room_id='$OID'";
    $result = mysqli_query($conn, $SQL);
    if(mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $ID = $row["room_id"];
            $NAME = $row["room_name"];
            $AVAILABILITY = $row["room_availability"];
            $PRICE = $row["room_price"];
            $RATE = $row["room_rating"];
            $DESC = $row["room_description"];
            $LOCATION = $row["room_location"];
        }
    } else {
        echo "Room not found";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ashton Hotel - Room Edit Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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

        .form-group {
            margin-bottom: 20px;
            overflow: hidden;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-group input[type=text],
        .form-group input[type=number],
        .form-group input[type=file] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-group input[type=file] {
            padding: 8px 0; /* Adjust vertically for file input */
        }

        .form-group input[type=submit],
        .form-group input[type=reset] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group input[type=submit]:hover,
        .form-group input[type=reset]:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .topnav a {
                padding: 15px 10px;
            }
        }
    </style>
</head>

<body class="body_bg">

    <!-- Header Section -->
    <div class="header" style="opacity:70%">
        <img src="header.jpg" width="100%" alt="ashton logo">
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

    <div class="container">

        <div class="center">
            <h1 style="text-align: center;">ROOM EDIT FORM</h1>
        </div>

        <div align="center">

            <form name="Room_edit_form" method="post" action="http://localhost//hotel/Room_edit_form.php">

                <div class="center">
                    <input type="hidden" name="room_id" value="<?php echo $ID ?>" />
                    <table>
                        <tr>
                            <td><label>Room Name</label></td>
                            <td><input type="text" name="room_name" value="<?php echo $NAME ?>" required></td>
                        </tr>

                        <tr>
                            <td><label>Room Availability</label></td>
                            <td><input type="number" name="room_availability" value="<?php echo $AVAILABILITY ?>" required></td>
                        </tr>

                        <tr>
                            <td><label>Room Price(RM)</label></td>
                            <td><input type="number" name="room_price" value="<?php echo $PRICE ?>" required></td>
                        </tr>

                        <tr>
                            <td><label>Room Rating</label></td>
                            <td><input type="number" name="room_rating" value="<?php echo $RATE ?>" required></td>
                        </tr>

                        <tr>
                            <td><label>Room Description</label></td>
                            <td><input type="text" name="room_description" value="<?php echo $DESC ?>" required></td>
                        </tr>

                        <tr>
                            <td><label>Room Location</label></td>
                            <td><input type="text" name="room_location" value="<?php echo $LOCATION ?>" required></td>
                        </tr>

                        <tr>
                            <td style="text-align:right"><input type="reset" value="Reset" class="submit"></td>
                            <td style="text-align:right"><input type="submit" name="submit" value="Submit" class="submit"></td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>

</body>

</html>

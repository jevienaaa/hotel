<?php

session_start();
include "Database_connection.php";

    if(isset($_POST['submit']))
    {
        //Insert    
        $OWID=$_POST['owner_id'];
        //echo $OWID;
        $OWNAME=$_POST['owner_name'];
        $OWPASSWORD=$_POST['owner_password'];
        $sql=" UPDATE owner SET owner_name='$OWNAME',owner_password='$OWPASSWORD WHERE owner_id='$OWID'";
        
        if(!mysqli_query($conn,$sql)){
            echo'<script>alert("Not Inserted")</script>';
            echo'<script>window.location="http://localhost/hotel/Admin_list.php"</script>';
        }
        else
            header("location: http://localhost/Hotel/Admin_list.php");
        }

        elseif(isset($_GET['id'])){
            $OWID=$_GET['id'];
            $SQL= "SELECT * FROM owner WHERE owner_id='$OWID' ";
            $result = mysqli_query($conn, $SQL);
            if(mysqli_num_rows($result)>0)
        {
        while ($row = $result->fetch_assoc()){
            $OWID=$row["owner_id"];
            $OWNAME=$row["owner_name"];
            $OWPASSWORD=$row["owner_password"];
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
    <title>Ashton Hotel - Admin Edit Form</title>
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
s        <a href="Room_list.php">ROOM DETAILS</a>
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

        <div class>
            <h1 style="text-align: center;">ADMIN EDIT FORM</h1>
        </div>

    <div align="center">

    <form name="Admin_edit_form" method="post" action="http://localhost/hotel/Admin_edit_form.php" >
    
        <div class="center">
        <input type="hidden" name="owner_id" value="<?php echo $OWID ?>"/>
    	<table>
            
            <tr>
                <td><label>Admin Name</label></td>
                <td><input type="text" name="owner_name" value="<?php echo $OWNAME ?>"required></input></td>
            </tr>

            <tr>
                <td><label>Password</label></td>
                <td><input type="number" name="owner_password" value="<?php echo $OWPASSWORD ?>" required></input></td>
            </tr>

                <td style="text-align:right"><input type="reset" value="Reset" class="submit" ></td>
                <td style="text-align:right"><input type="submit" name="submit" value="Submit" class="submit"></td>    
            </tr> 

        </table>
    </form>
</div>

</body>
</html>

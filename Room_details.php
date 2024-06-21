<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$database = "hotel";

$connect = mysqli_connect($host, $user, $password, $database);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

function getPosts()
{
    global $connect;
    $posts = array();
    $posts[0] = isset($_POST['booking_cid']) ? mysqli_real_escape_string($connect, $_POST['booking_cid']) : '';
    $posts[1] = isset($_POST['booking_cod']) ? mysqli_real_escape_string($connect, $_POST['booking_cod']) : '';
    $posts[2] = isset($_POST['room_id']) ? mysqli_real_escape_string($connect, $_POST['room_id']) : '';
    $posts[3] = isset($_POST['no_booking']) ? mysqli_real_escape_string($connect, $_POST['no_booking']) : '';
    return $posts;
}

if (isset($_POST['insert'])) {
    $data = getPosts();
    $insert_Query = "INSERT INTO booking (booking_cid, booking_cod, room_id, no_booking) VALUES ('$data[0]', '$data[1]', '$data[2]', '$data[3]')";

    try {
        $insert_Result = mysqli_query($connect, $insert_Query);
        if ($insert_Result) {
            if (mysqli_affected_rows($connect) > 0) {
                // Retrieve the last inserted ID
                $booking_id = mysqli_insert_id($connect);

                // Store the booking ID in the session
                $_SESSION['latest_booking_id'] = $booking_id;

                // Redirect to the payment page
                echo '<script>window.location="http://localhost/hotel/payment.php"</script>';
            }
        }
    } catch (Exception $ex) {
        echo '<script>alert("Error booking. Try again")</script>' . $ex->getMessage();
        header("Location: http://localhost/Project/hotel/Room_list_2.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ashton Hotel - Room Details</title>
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
            color: #333;
        }

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

        .topnav {
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.5);
            font-family: 'Montserrat', sans-serif;
        }

        .topnav a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 20px 30px;
            text-decoration: none;
            font-weight: normal;
        }

        .topnav a:hover {
            background-color: #9f6060;
        }

        .topnav a img {
            height: 18px;
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
            font-size: 40px;
            font-weight: normal;
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
        
        .table-background {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            overflow-x: auto;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header" style="opacity: 0.7;">
        <img src="header.jpg" width="100%" alt="Ashton Hotel Logo">
    </div>

    <!-- Navigation -->
    <div class="topnav">
        <a href="guest.nav.php"><img src="home-icon.png" id="home-icon" alt="Home Icon"></a>
        <a href="Room_list_2.php">ROOM DETAILS</a>
        <a href="Room_search.php">ROOM SEARCH</a>
        <img src="audio-icon.png" style="float: right; margin: 10px; cursor: pointer;" class="audio-icon" id="audio-icon" alt="Audio Icon" width="32" height="32">
        <audio id="background-audio" src="song.mp3"></audio>  
        <a style="float:right" href="logout.php">LOGOUT</a>
        <a style="float:right" href="http://localhost/Project/Hotel/Room_list_2.php" class="previous">&laquo; Previous</a>
        <a style="float:right" href="" class="next">Next&raquo;</a>

    </div>

    <!-- Room Details Form -->
    <div class="container">
        <div>
            <h1 style="text-align: center; color:black;">Room Details</h1>
        </div>

        <form method="post" class="display">
            <table style="overflow-x:auto;" class="table table-hover">
                <thead>
                    <tr style="color:black; font-size: 20px; text-align:center;">
                        <th>Room</th>
                        <th>No of booking</th>
                        <th>Booking Check In Date</th>
                        <th>Booking Check Out Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="color:black; font-size: 20px;">
                    <?php
                    $OID = mysqli_real_escape_string($connect, $_GET['id']);
                    $SQL = "SELECT * FROM room WHERE room_id='$OID'";
                    $result = mysqli_query($connect, $SQL);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td>
                                    <h4 class="text"><?php echo $row["room_name"]; ?></h4>
                                    <img src="Image/<?php echo $row["room_id"]; ?>.jpg" style="width:150px;height:160px">
                                    <h4 class="text"><?php echo $row["room_location"]; ?></h4>
                                    <h4 class="text"><?php echo $row["room_availability"]; ?></h4>
                                    <h4 class="text"><?php echo "RM" . $row["room_price"]; ?></h4>
                                    <h4 class="text"><?php echo $row["room_description"]; ?></h4>
                                </td>
                                <td>
                                    <input type="number" name="no_booking" required>
                                </td>
                                <td>
                                    <input type="date" name="booking_cid" required>
                                </td>
                                <td>
                                    <input type="date" name="booking_cod" required>
                                </td>
                                <td>
                                    <input type="hidden" name="room_id" value="<?php echo $row["room_id"]; ?>">
                                    <input type="submit" name="insert" value="BOOK">
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>

</body>
</html>

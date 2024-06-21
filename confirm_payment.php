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

// Check if booking ID is stored in session
if (isset($_SESSION['latest_booking_id'])) {
    $booking_id = $_SESSION['latest_booking_id'];

    // Fetch booking details from the database
    $query = "SELECT booking_cid, booking_cod, room_id, no_booking FROM booking WHERE booking_id = $booking_id";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $booking_cid = $row['booking_cid'];
        $booking_cod = $row['booking_cod'];
        $room_id = $row['room_id'];
        $no_booking = $row['no_booking'];

        // Format dates for display
        $check_in_date = date('Y-m-d', strtotime($booking_cid));
        $check_out_date = date('Y-m-d', strtotime($booking_cod));

        // Fetch room details using room_id
        $room_query = "SELECT room_name FROM room WHERE room_id = $room_id";
        $room_result = mysqli_query($connect, $room_query);
        if ($room_result && mysqli_num_rows($room_result) > 0) {
            $room_row = mysqli_fetch_assoc($room_result);
            $room_name = $room_row['room_name'];
        } else {
            $room_name = "Room details not found";
        }
    } else {
        // Handle case where booking details are not found
        echo "Error: Booking details not found.";
        exit;
    }

    // Example: Fetching card holder's name from payment page
    $card_holder_name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';

} else {
    // Redirect if booking ID is not set in session
    header("Location: http://localhost/hotel/Room_list_2.php");
    exit;
}

mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        /* General Styling */
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

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }

        .container h3 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        .btn-print {
            display: block;
            margin: 20px auto;
            text-align: center;
        }

        .btn-print button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .btn-print button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <img src="header.jpg" alt="Ashton logo">
    </div>

    <div class="topnav">
        <a href="guestnav.php"><img src="home-icon.png" id="home-icon" alt="Home Icon"></a>
        <img src="audio-icon.png" class="audio-icon" id="audio-icon" alt="Audio Icon" width="32" height="32" style="float: right; margin: 10px; cursor: pointer;">
        <audio id="background-audio" src="song.mp3"></audio>
    </div>

    <div class="container">
        <h3>Booking Confirmation</h3>
        <table>
            <tr>
                <th>Booking ID</th>
                <td><?php echo htmlspecialchars($booking_id); ?></td>
            </tr>
            <tr>
                <th>Room Name</th>
                <td><?php echo htmlspecialchars($room_name); ?></td>
            </tr>
            <tr>
                <th>No of Booking</th>
                <td><?php echo htmlspecialchars($no_booking); ?></td>
            </tr>
            <tr>
                <th>Check-in Date</th>
                <td><?php echo htmlspecialchars($check_in_date); ?></td>
            </tr>
            <tr>
                <th>Check-out Date</th>
                <td><?php echo htmlspecialchars($check_out_date); ?></td>
            </tr>
            <tr>
                <th>Card Holder's Name</th>
                <td><?php echo htmlspecialchars($card_holder_name); ?></td>
            </tr>
            <!-- Add more details as needed -->
        </table>
        <p style="text-align: center;">Thank you for booking with Ashton Hotel. Please contact us for any inquiries.</p>

        <!-- Print Button -->
        <div class="btn-print">
            <button onclick="printPage()">Print Confirmation</button>
        </div>
    </div>

    <!-- JavaScript for Print Function -->
    <script>
        function printPage() {
            window.print();
        }
    </script>

        <!-- Audio control script -->
        <script>
        document.getElementById('audio-icon').addEventListener('click', function() {
            var audio = document.getElementById('background-audio');
            if (audio.paused) {
                audio.play();
                this.src = 'audio-on-icon.png';
            } else {
                audio.pause();
                this.src = 'audio-off-icon.png';
            }
        });
</body>
</html>

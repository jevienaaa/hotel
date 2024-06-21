<?php
session_start();
include "Database_connection.php";

// Establish database connection
$con = mysqli_connect("localhost", "root", "", "hotel");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle search functionality
if (isset($_GET['search'])) {
    $filtervalues = $_GET['search'];
    $query = "SELECT * FROM room WHERE CONCAT(room_id, room_name, room_image, room_location, room_availability, room_price, room_rating, room_description) LIKE '%$filtervalues%' ";
    $query_run = mysqli_query($con, $query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashton Hotel - Room List</title>
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
            background: radial-gradient(circle, rgba(60, 51, 94, 1) 30%, rgba(134, 87, 79, 1) 100%);
            background-size: cover;
            color: #333;
        }

        .header {
            padding: 5px;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.9);
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
        }

        .topnav a:hover {
            background-color: #9f6060;
        }

        .topnav a img {
            height: 18px;
            vertical-align: middle;
        }

        h1 {
            font-size: 40px;
            font-weight: normal;
            text-align: center;
        }

        .container {
            text-align: center;
            padding-top: 20px;
            padding-bottom: 10px;
        }

        .table-background {
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            overflow-x: auto;
        }

        /* Improved Search Form Styling */
        .search-form {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .search-form .form-control {
            width: calc(100% - 120px); /* Adjust width as needed */
            display: inline-block;
            margin-right: 10px;
        }

        .search-form .btn-primary {
            width: 100px; /* Adjust width as needed */
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <div class="header">
        <img src="header.jpg" alt="Ashton Hotel Logo">
    </div>

    <!-- Navigation -->
    <div class="topnav">
        <a href="guestnav.php"><img src="home-icon.png" id="home-icon" alt="Home Icon"></a>
        <a href="Room_list_2.php">ROOM DETAILS</a>
        <a href="Room_search.php">ROOM SEARCH</a>
        <img src="audio-icon.png" style="float: right; margin: 10px; cursor: pointer;" class="audio-icon" id="audio-icon" alt="Audio Icon" width="32" height="32">
        <audio id="background-audio" src="song.mp3"></audio>
        <a style="float:right" href="logout.php">LOGOUT</a>
        <a style="float:right" href="http://localhost/hotel/guestnav.php" class="previous">&laquo; Previous</a>
        <a style="float:right" href="http://localhost/hotel/Room_list_2.php" class="next">Next &raquo;</a>
    </div>

    <!-- Search Form -->
    <div class="container">
        <form action="" method="GET" class="search-form">
            <div class="input-group">
                <input type="text" name="search" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" class="form-control" placeholder="Search data" required>
                <div class="input-group-btn">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <!-- Room List -->
        <div>
            <h1 style="color:black;">Room List</h1>
        </div>

        <div class="table-background">
            <table class="table table-hover">
                <thead>
                    <tr style="color:black; font-size: 20px; text-align:center;">
                        <th>Room Name</th>
                        <th>Room Location</th>
                        <th>Room Availability</th>
                        <th>Price (RM)</th>
                        <th>Rating</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody style="color:black">
                    <?php
                    if (isset($_GET['search']) && mysqli_num_rows($query_run) > 0) {
                        foreach ($query_run as $items) {
                    ?>
                            <tr>
                                <td><?= htmlspecialchars($items['room_name']); ?></td>
                                <td><?= htmlspecialchars($items['room_location']); ?></td>
                                <td><?= htmlspecialchars($items['room_availability']); ?></td>
                                <td><?= htmlspecialchars($items['room_price']); ?></td>
                                <td><?= htmlspecialchars($items['room_rating']); ?></td>
                                <td><?= htmlspecialchars($items['room_description']); ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="6">No Record Found</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

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
    </script>

</body>

</html>

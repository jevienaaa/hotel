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
    <!-- Header with opacity -->
    <div class="header">
        <img src="header.jpg" alt="Ashton Logo">
    </div>

    <!-- Navigation bar -->
    <div class="topnav">
        <a href="adminnav.php"><img src="home-icon.png" id="home-icon" alt="Home Icon"></a>
        <a href="Room_list_2.php">ROOM DETAILS</a>
        <a href="Room_search.php">ROOM SEARCH</a>
        <img src="audio-icon.png" class="audio-icon" id="audio-icon" alt="Audio Icon" width="32" height="32" style="float: right; margin: 10px; cursor: pointer;">
        <audio id="background-audio" src="song.mp3"></audio>
        <a href="logout.php" style="float:right">LOGOUT</a>
        <a href="http://localhost/hotel/guestnav.php" class="previous" style="float:right">&laquo; Previous</a>
        <a href="http://localhost/hotel/Room_list_2.php" class="next" style="float:right">Next &raquo;</a>

    </div>

    <!-- Container for the room list -->
    <div class="container table-background">      
        <h1>Room List</h1>
        <table class="table table-hover">
            <thead>
                <tr style="color:black; font-size: 20px; text-align:center;">
                    <th>Room Name</th>
                    <th>Room</th>
                    <th>Room Location</th>
                    <th>Room Availability</th>
                    <th>Price (RM)</th>
                    <th>Rating</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody style="color:black">
                <?php
                $sql = "SELECT * FROM room";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row["room_name"]); ?></td>
                    <td><img src="Image/<?php echo htmlspecialchars($row["room_image"]); ?>" style="width:150px; height:160px;" alt="Room Image"></td>
                    <td><?php echo htmlspecialchars($row["room_location"]); ?></td>
                    <td><?php echo htmlspecialchars($row["room_availability"]); ?></td>
                    <td><?php echo htmlspecialchars($row["room_price"]); ?></td>
                    <td><?php echo htmlspecialchars($row["room_rating"]); ?></td>
                    <td><?php echo htmlspecialchars($row["room_description"]); ?></td>
                    <td><button class="btn btn-primary" onclick="window.location.href='Room_details.php?id=<?php echo $row["room_id"]; ?>'">View</button></td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center'>No rooms found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
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

<!DOCTYPE html>
<html>
<head>
    <title>Monthly Booking Report</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
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
<main>
    <div class="container">
        <div>
            <h1 style="text-align:center;" >SALES REPORT</h1>
        </div>

        <section class="section">
            <!-- Google Charts -->
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                        ['Month', 'Bookings'],
                        <?php
                        // PHP code to fetch data and generate Google Charts data array
                        include "Database_connection.php";

                        // Initialize an array to hold monthly data
                        $monthly_data = array_fill(1, 12, 0);

                        // Current year
                        $year = date("Y");

                        // Query to fetch sum of bookings grouped by month
                        $query = "SELECT MONTH(booking_cid) as month, SUM(no_booking) as total_bookings 
                                  FROM booking 
                                  WHERE YEAR(booking_cid) = $year 
                                  GROUP BY MONTH(booking_cid)";

                        $result = mysqli_query($conn, $query);

                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $month = intval($row['month']);
                                $total_bookings = intval($row['total_bookings']);
                                $monthly_data[$month] = $total_bookings;
                            }
                        }

                        // Generate chart data rows
                        foreach ($monthly_data as $month => $bookings) {
                            echo "['" . date("F", mktime(0, 0, 0, $month, 1)) . "', " . $bookings . "],";
                        }
                        ?>
                    ]);

                    var options = {
                        chart: {
                            title: 'Monthly Booking Report'
                        }
                    };

                    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            </script>

            <div id="columnchart_material" style="width: 80%; height: 450px; margin: 0 auto;"></div>
        </section>
    </div>
</main>

<!-- Print Button -->
<br>
<center>
    <button onclick="window.print()" class="noPrint">Print</button>
</center>
<br>

<!-- Bootstrap and jQuery Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>
</html>

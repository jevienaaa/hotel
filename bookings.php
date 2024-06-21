<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
    // Redirect to login page if not logged in
    header("Location: customer_login.php");
    exit;
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'hotel');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare SQL statement to fetch bookings for the logged-in user
$user_id = $_SESSION['cus_name']; // Assuming 'cus_name' is the username used for login
$sql = "SELECT * FROM booking WHERE booking_cus_name=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch and display bookings
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here */
    </style>
</head>
<body>

<div class="container">
    <h1>My Bookings</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Room ID</th>
                    <th>Check-in Date</th>
                    <th>Check-out Date</th>
                    <th>No of Bookings</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['booking_id'] . "</td>";
                        echo "<td>" . $row['room_id'] . "</td>";
                        echo "<td>" . $row['booking_cid'] . "</td>";
                        echo "<td>" . $row['booking_cod'] . "</td>";
                        echo "<td>" . $row['no_booking'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No bookings found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>

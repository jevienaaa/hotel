<?php
session_start();
include "Database_connection.php"; 

$error_message = '';

if(isset($_POST['submit'])) {
    $NAME = $_POST['cus_name'];
    $PASSWORD = $_POST['cus_password'];
    $BIRTHDAY = $_POST['cus_dob'];
    $ADDRESS = $_POST['cus_address'];
    $HP = $_POST['cus_hpno'];

    // Perform basic validation if needed
    if (empty($NAME) || empty($PASSWORD) || empty($BIRTHDAY) || empty($ADDRESS) || empty($HP)) {
        $error_message = "Please fill in all fields.";
    } else {
        // Sanitize inputs
        $NAME = mysqli_real_escape_string($conn, $NAME);
        $BIRTHDAY = mysqli_real_escape_string($conn, $BIRTHDAY);
        $ADDRESS = mysqli_real_escape_string($conn, $ADDRESS);
        $HP = mysqli_real_escape_string($conn, $HP);

        // Hash the password
        $hashed_password = password_hash($PASSWORD, PASSWORD_DEFAULT);

        // Prepare and execute SQL statement using prepared statements
        $sql = "INSERT INTO customer (cus_name, cus_password, cus_dob, cus_address, cus_hpno) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $NAME, $hashed_password, $BIRTHDAY, $ADDRESS, $HP);

        if ($stmt->execute()) {
            $_SESSION['registration_success'] = true; // Optional: Set a session flag for registration success
            header("Location: customer_login.php"); // Redirect to login page after successful registration
            exit();
        } else {
            $error_message = "Registration failed. Please try again."; // Display error message on failure
        }

        $stmt->close();
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ashton Hotel - Guest Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <style>
        /* General styles */
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
            float: left;
            display: block;
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

        .audio-icon {
            float: right;
            margin: 12px;
            cursor: pointer;
            vertical-align: middle;
        }

        /* Main content container */
        .content {
            padding: 20px;
            max-width: 400px;
            margin: 30px auto; /* Center align content */
            background-color: rgba(255, 255, 255, 0.8); /* Translucent white background */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            color: #333; /* Dark text color */
        }
        .content h1 {
            font-size: 2.5em;
            border-bottom: 6px solid #9f6060; /* Change to desired color */
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        .content form {
            margin-top: 20px;
            text-align: left;
            padding: 0 20px; /* Padding for form elements */
            position: relative; /* Ensure relative positioning for eye icon */
        }
        .content .text_box {
            margin-bottom: 20px;
            position: relative; /* Ensure relative positioning for eye icon */
        }
        .content .text_box label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333; /* Label text color */
        }
        .content .text_box input {
            width: calc(100% - 40px);
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease; /* Smooth transition for input focus */
        }
        .content .text_box input:focus {
            outline: none;
            border-color: #4CAF50; /* Green border color on focus */
        }
        .content .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
        .content .eye-icon img {
            width: 20px;
            height: auto;
            opacity: 0.5;
            transition: opacity 0.3s ease;
        }
        .content .eye-icon img:hover {
            opacity: 1;
        }
        .content button {
            width: 100%;
            background-color: #4CAF50; /* Green background color */
            color: white; /* Text color */
            border: none;
            padding: 10px;
            font-size: 1.2em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease; /* Smooth transition on hover */
        }
        .content button:hover {
            background-color: #45A049; /* Darker green on hover */
        }
        .content .psw {
            margin-top: 15px;
            font-size: 0.9em;
        }
        .content .psw a {
            color: #4CAF50; /* Link color */
        }
        .content .psw a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <img src="header.jpg" alt="Ashton Hotel Logo">
    </div>

    <!-- Navigation bar -->
    <div class="topnav">
        <a href="homepage.php"><img src="home-icon.png" id="home-icon" alt="Home Icon"></a>
        <a href="customer_login.php">GUEST</a>
        <a href="owner_login.php">ADMIN</a>
        <img src="audio-icon.png" class="audio-icon" id="audio-icon" alt="Audio Icon" width="32" height="32">
        <audio id="background-audio" src="song.mp3"></audio>
    </div>

    <!-- Main content -->
<!-- Main content -->
<div class="content">
    <h1>GUEST REGISTRATION FORM</h1>

    <!-- Registration form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="text_box">
            <label for="cus_name">Guest Username:</label>
            <input type="text" placeholder="Enter Username" name="cus_name" id="cus_name" required>
        </div>
        <div class="text_box">
            <label for="cus_password">Password:</label>
            <div style="position: relative;">
                <input type="password" placeholder="Enter Password" name="cus_password" id="cus_password" required>
                <span class="eye-icon" onclick="togglePasswordVisibility()">
                    <img src="eye-open.png" alt="eye" width="20" height="20">
                </span>
            </div>
        </div>
        <div class="text_box">
            <label for="cus_dob">DOB (dd/mm/yyyy):</label>
            <input type="text" placeholder="Enter Date of Birth" name="cus_dob" id="cus_dob" required>
        </div>
        <div class="text_box">
            <label for="cus_address">Address:</label>
            <input type="text" placeholder="Enter Address" name="cus_address" id="cus_address" required>
        </div>
        <div class="text_box">
            <label for="cus_hpno">Contact Number:</label>
            <input type="text" placeholder="Enter Contact Number" name="cus_hpno" id="cus_hpno" required>
        </div>

        <!-- Display error message if any -->
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <!-- Submit button -->
        <button type="submit" name="submit">Register</button>

        <!-- Link to login page -->
        <p class="psw">Already have an account? <a href="customer_login.php">Login here</a>.</p>
    </form>
</div>

<!-- JavaScript for toggle password visibility -->
<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("cus_password");
        var eyeIcon = document.querySelector(".eye-icon img");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.src = "eye-closed.png"; // Update image for close eye
        } else {
            passwordInput.type = "password";
            eyeIcon.src = "eye-open.png"; // Update image for open eye
        }
    }

    // Datepicker for Date of Birth field
    $("#cus_dob").datepicker({
        dateFormat: 'dd/mm/yy', // Date format
        changeMonth: true, // Show month dropdown
        changeYear: true, // Show year dropdown
        yearRange: "-100:+0" // 100 years range from current year to past
    });
</script>

<?php include "audio_control.php"; ?>


</body>
</html>

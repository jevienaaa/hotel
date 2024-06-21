<?php
session_start();
$error_message = '';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ownerid = $_POST['ownerid'];
    $ownername = $_POST['ownername'];
    

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'hotel');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare SQL statement
    $sql = "SELECT * FROM owner WHERE owner_id=?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Statement preparation failed: " . $conn->error);
    }
    
    $stmt->bind_param("s", $ownerid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        // Fetch the user data
        $user = $result->fetch_assoc();
        echo $user['owner_id'];
        echo $ownerid;

        // Verify the password
        //if ($ownername == $user['owner_name'] && password_verify($password, $user['owner_password'])) {
          if ($ownername == $user['owner_name'] && $ownerid == $user['owner_id']){
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['ownername'] = $ownername;
            $_SESSION['ownerid'] = $ownerid;

            header('Location: adminnav.php');
            exit();
        } else {
            $error_message = 'Invalid username or password, try <a href="owner_login.php">Login</a> again.';
        }
    } else {
        $error_message = 'Invalid username or password, try <a href="owner_login.php">Login</a> again.';
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ashton Hotel - Admin Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
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
    <div class="content">
        <h1>ADMIN LOGIN</h1>

        <!-- Login form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="text_box">
                <label for="ownername">Admin Name:</label>
                <input type="text" placeholder="Enter Admin Name" name="ownername" id="ownername" required>
            </div>
            <div class="text_box">
                <label for="ownerid">Admin ID:</label>
                <input type="text" placeholder="Enter Admin ID" name="ownerid" id="ownerid" required>
            </div>
            
            <!-- <div class="text_box">
                <label for="password">Password:</label>
                <div style="position: relative;">
                    <input type="password" placeholder="Enter Password" name="password" id="password" required>
                    <span class="eye-icon" onclick="togglePasswordVisibility()">
                        <img src="eye-open.png" alt="eye" width="20" height="20">
                    </span> -->
                <!-- </div> -->
            <!-- </div> -->
            <button type="submit" name="submit">Login</button>
            <?php
            if (!empty($error_message)) {
                echo '<p class="psw">' . $error_message . '</p>';
            }
            ?>
            <p class="psw">Not Registered? <a href="admin_registration.php">Register here.</a></p>
        </form>
    </div>

    <!-- <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById("password");
            var eyeIcon = document.querySelector(".eye-icon img");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.src = "eye-closed.png";
            } else {
                passwordField.type = "password";
                eyeIcon.src = "eye-open.png";
            }
        }
    </script> -->
</body>
</html>

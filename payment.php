<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ashton Hotel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        /* Custom Fonts */
        @font-face {
            font-family: myFont;
            src: url('jak.woff');
        }

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

        /* Navigation Styling */
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

        /* Audio Controls */
        .audio-icon {
            float: right;
            margin: 10px;
            cursor: pointer;
        }

        /* Payment Form Styling */
        .payment-form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }

        .payment-form h3 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .payment-form table {
            width: 100%;
        }

        .payment-form td {
            padding: 10px;
        }

        .payment-form input[type="text"],
        .payment-form input[type="number"],
        .payment-form input[type="date"],
        .payment-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        .payment-form input[type="submit"] {
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .payment-form input[type="submit"]:hover {
            background-color: darkgreen;
        }

        /* Responsive Adjustments */
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
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <img src="header.jpg" alt="Ashton logo">
    </div>

    <!-- Top Navigation Bar -->
    <div class="topnav">
        <a href="guestnav.php">HOME</a>
        <a href="Room_list_2.php">ROOM DETAILS</a>
        <a href="Room_search.php">ROOM SEARCH</a>
        <img src="audio-icon.png" style="float: right; margin: 10px; cursor: pointer;" class="audio-icon" id="audio-icon" alt="Audio Icon" width="32" height="32">
        <audio id="background-audio" src="song.mp3"></audio>          
		<a href="logout.php" style="float:right">LOGOUT</a>
        <a href="http://localhost/hotel/Room_list_2.php" class="previous" style="float:right">&laquo; Previous</a>
        <a href="#" class="next" style="float:right">Next &raquo;</a>
    </div>

    <!-- Payment Form -->
    <div class="payment-form">
        <h3>MAKE PAYMENTS HERE</h3>
        <form method="post" action="confirm_payment.php">
            <table>
                <tr>
                    <td>Card Holder's Name:</td>
                    <td><input type="text" name="name" required></td>
                </tr>
                <tr>
                    <td>IC Number:</td>
                    <td><input type="number" name="ic_no" required></td>
                </tr>
                <tr>
                    <td>Card Number:</td>
                    <td><input type="number" name="card_number" required></td>
                </tr>
                <tr>
                    <td>Card Expiry Date:</td>
                    <td><input type="date" name="exp_date" required></td>
                </tr>
                <tr>
                    <td>Card CVV:</td>
                    <td><input type="number" name="cvv" required></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:right">
                        <input type="submit" name="pay" value="Pay Now">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

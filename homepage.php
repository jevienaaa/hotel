<!DOCTYPE html>
<html lang="en">
<head>
  <title>Ashton Hotel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
  <style>

    @font-face {
      font-family: myFont;
      src: url('jak.woff');
    }
    
    body {
      background-repeat: no-repeat;
      background: radial-gradient(circle,  rgba(60,51,94,1) 30%,  rgba(134,87,79,1) 100%); 
      min-height: 100vh;
      margin: 0;
      font-family: 'Montserrat', sans-serif;
      color: white;
      display: flex;
      flex-direction: column;
    }

    .header {
      padding: 5px;
      text-align: center;
      background-color: black;
      opacity: 0.7;
    }

    .topnav {
      overflow: hidden;
      background-color: black;
      opacity: 0.7;
    }

    .topnav a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    .topnav a:hover {
      background-color: #9f6060;
    }

    .audio-icon {
      float: right;
      margin: 10px;
      cursor: pointer;
    }

    .flip-box {
      background-color: transparent;
      color: white;
      width: 100%;
      max-width: 600px;
      margin: 30px auto;
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
      font-size: 50px;
      /* font-weight: bold; */
    }

    .footer {
      padding: 10px;
      background-color: black;
      color: white;
      text-align: center;
      opacity: 0.5;
      position: absolute;
      bottom: 0;
      width: 100%;
    }

    .login-options {
      text-align: center;
      margin-top: 30px;
      font-family: 'Montserrat', sans-serif; /* Updated to Montserrat */
    }

    .login-link {
      display: inline-block;
      padding: 10px 20px;
      background-color: #9f6060;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      margin: 0 10px;
      /* font-weight: bold; */
      transition: background-color 0.3s ease;
      font-family: 'Montserrat', sans-serif; /* Updated to Montserrat */
    }

    .login-link:hover {
      background-color: #7e4747;
      color: white;
    }

    @media (max-width: 767px) {
      .topnav a {
        float: none;
        display: block;
        text-align: center;
      }

      .audio-icon {
        float: none;
        display: block;
        margin: 0 auto;
      }
    }
  </style>
</head>
<body>

<header class="header">
  <img src="header.jpg" class="img-responsive center-block" alt="Ashton logo">
</header>

<nav class="topnav">
  <div class="container-fluid">
    <img src="audio-icon.png" class="audio-icon" id="audio-icon" alt="Audio Icon" width="32" height="32">
    <audio id="background-audio" src="song.mp3"></audio>
  </div>
</nav>

<main>
  <div class="login-options">
    <a href="customer_login.php" class="login-link">Guest Login</a>
    <a href="owner_login.php" class="login-link">Admin Login</a>
  </div>

  <div class="flip-box">
    <div class="flip-box-inner">
      <div class="flip-box-front">
        <h1>Welcome</h1>
        <h1>to</h1>
        <h1>Ashton Hotel</h1>
      </div>
      <div class="flip-box-back">
        <h1>Online</h1>
        <h1>Hotel Booking</h1>
        <h1>System</h1>
      </div>
    </div>
  </div>
</main>

<footer class="footer">
  <p>© Ashton Hotel</p>
</footer>

<script>
  const audioIcon = document.getElementById('audio-icon');
  const audio = document.getElementById('background-audio');

  audioIcon.addEventListener('click', () => {
    if (audio.paused) {
      audio.play();
    } else {
      audio.pause();
    }
  });
</script>

</body>
</html>

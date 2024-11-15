<?php

$name = $date = $time = $guests = $tableNo = "";
$today = date("Y-m-d"); 
$currentTime = date("H:i"); 
$confirmationMessage = "";

session_start();

//echo isset($_SESSION['user_email']) ? $_SESSION['user_email'] : 'Session not set';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION['user_email'])) {
        $email = $_SESSION['user_email'];
        $sub = "test";
        $name = $_POST['name'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $guests = $_POST['guests'];
        $tableNo = $_POST['tableno'];

        $message = "
        Name: $name
        Date: $date
        Time: $time
        Guests: $guests
        Table No: $tableNo
        Email: $email
        ";
        $from = "venkatsadhanala169@gmail.com";
        $headers = "From: $from";

        $check = mail($email, $sub, $message, $headers);
        echo $check ? "Email sent" : "Email not sent successfully";
    } else {
        echo "User email is not set. Please log in to make a reservation.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Athidhi Restaurant</title>
    <link real="Stylesheet" href="Home.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="about.css">

    <style>
        * {
    margin: 0;
    padding:5px;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    color: #333;
    background-color: #f4f4f4;
}

.home {
    font-family: 'Times New Roman', Times, serif;
    color: #333;
    padding: 50px;
    width: 100%;
    height: 100vh;
    position: relative;
    top: 40px; 
    overflow-y: auto;
}
.hero {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 70vh;
    max-width: 1100px;
    margin: 0 auto;
    border-radius: 20px;
    color: #fff;
    text-align: center;
    padding: 50px 20px;
  }

.reserve-button {
    background-color: #ffa500;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 20px;
}

.reserve-button:hover {
    background-color: #ff8c00;
}

.reservation-form {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    backdrop-filter: blur(5px);
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 02px;
    max-width: 500px;
    width: 100%;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    z-index: 2;
    display: none;
    bottom: 40px;
}

.reservation-form h2 {
    text-align: center;
    margin-top: 0;
    color: #333;
}

.reservation-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333;
}

.reservation-form input {
    width: calc(100% - 10px);
    padding: 8px;
    margin-bottom: 15px;
    color: black;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.grid-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}

.grid-item label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.grid-item input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.reservation-form button {
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: white;
    background-color: #333;
    justify-content: space-between;
}

.reservation-form button[type="submit"], button[type="button"] {
    padding: 10px 20px;
    margin: 5px 20px;
    border-radius: 5px;
    cursor: pointer;
}

.confirmation-message {
    text-align: center;
    padding: 10px;
    color: green;
    font-weight: bold;
}

.footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px;
    position: relative;
    bottom: 0;
    width: 100%;
}

.footer-content {
    margin: 0;
}

.footer-links {
    margin-top: 10px;
}

.footer-links a {
    color: white;
    text-decoration: none;
    margin: 0 10px;
}

.footer-links a:hover {
    text-decoration: underline;
}

@media (max-width: 580px) {
    .hero {
        padding: 30px 10px;
    }
    
    .reservation-form {
        width: 90%;
    }
}
        </style>
</head>
<body>

<div class="forback">
   

<nav class="navbar">
    <div class="logo">
        <a href="Home.php">Athidi Restaurant</a>
    </div>
    <ul class="nav-links">
        <li><a href="Home.php">Home</a></li>
        <li><a href="Menu.php">Menu</a></li>
        <li><a href="Orders.php">Orders</a></li>
        <li><a href="Contact.php">Contact</a></li>

        <?php if (isset($_SESSION['user_email'])): ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="Login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>




    <div class="home"
    style="
    background-image: url('./public/images/background.jpg');
    background-size: cover;
    background-position: center center;
    background-attachment: fixed;
    height:100vh;
    "

    >
        <header class="hero" style="background-color:transparent;
        backdrop-filter:blur(8px)">
            <h1>Welcome to Athidi Restaurant</h1>
            <p>Your favorite place for delicious food.</p>
            <button class="reserve-button" onclick="toggleReservation()">Reserve a Table</button>
        </header>

        <?php if ($confirmationMessage): ?>
            <div class="confirmation-message">
                <p><?php echo $confirmationMessage; ?></p>
            </div>
        <?php endif; ?>

        <div id="reservation-form" class="reservation-form" style="display: none; top:40%;">
            <h2>Reserve a Table</h2>
            <form method="post" onsubmit="return confirmReservation()">
            <label for="name">Name:</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Enter Name"
                    required
                />

                <div class="grid-container">
                    <div class="grid-item">
                        <label for="date">Date:</label>
                        <input
                            type="date"
                            id="date"
                            name="date"
                            min="<?php echo $today; ?>"
                            required
                        />
                    </div>

                    <div class="grid-item">
                        <label for="time">Time:</label>
                        <input
                            type="time"
                            id="time"
                            name="time"
                            min="<?php echo date('H:i'); ?>"
                            required
                        />
                    </div>

                    <div class="grid-item">
                        <label for="guests">Number of Guests:</label>
                        <input
                            type="number"
                            id="guests"
                            name="guests"
                            min="1"
                            required
                        />
                    </div>

                    <div class="grid-item">
                        <label for="tableno">Table No:</label>
                        <input
                            type="number"
                            id="tableno"
                            name="tableno"
                            min="1"
                            max="10"
                            required
                        />
        </div>
        </div>
                <button type="submit" class="confirm">Confirm Reservation</button>
                <button type="button" class="cancel" onclick="toggleReservation()">Cancel</button>
            </form>
        </div>
    </div>

    
<div class="about-container" style="margin-top:50px; left:60px">
    <section class="about-section">
        <h1 class="about-heading">About Us</h1>
        <p class="about-description">
            Welcome to Athidi Restaurant, where we serve delicious food made with love and passion. Our mission is to provide a memorable dining experience through exquisite dishes and exceptional service.
        </p>
    </section> 
    <br/><br/>

    <div class="our">
        <section class="mission-section">
            <img src="public\images\mutton biryani.jpeg" alt="">
            <p class="mission-description">
                Our mission is to create a unique dining experience for every guest, offering fresh and high-quality.
            </p> 
        </section>

        <section class="values-section">
            <img src="public\images\paneer-tikka.webp" alt="">
            <p class="mission-description">
            To support local farmers and producers by sourcing ingredients locally,relations and sustainability.</p>
        </section>
        <section class="mission-section">
            <img src="public\images\mutton-curry.webp" alt="">
            <p class="mission-description">
            Creative and dynamic work environment that inspires our team to deliver the best possible dining experience.
            </p> 
        </section>
        <section class="values-section">
            <img src="public\images\curd-rice.webp" alt="">
            <p class="mission-description">
            To prioritize customer feedback, our menu and services to meet and exceed customer expectations.  </p>
        </section>
    </div>
    <br/><br/>

    <section class="team-section">
        <h2 class="team-heading">Meet Our Team</h2>
        <div class="team-container">
            <div class="team-member">
                <h3 class="team-member-name">Bhavani</h3>
                <p class="team-member-role">Head Chef</p>
            </div>

            <div class="team-member">
                <h3 class="team-member-name">Deelip</h3>
                <p class="team-member-role">Restaurant Manager</p>
            </div>
        </div>
    </section>
</div>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Athidi Restaurant. All Rights Reserved.</p>
            <div class="footer-links">
                <a href="Home.php">About Us</a> | 
                <a href="Contact.php">Contact</a> |
                <a href="/privacy">Privacy Policy</a>
            </div>
        </div>
    </footer>
</div>

<script>
function toggleReservation() {
    const form = document.getElementById('reservation-form');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}

function confirmReservation() {
    const name = document.getElementById('name').value;
    const date = document.getElementById('date').value;
    const time = document.getElementById('time').value;
    const guests = document.getElementById('guests').value;

    return confirm(`Reservation confirmed for ${name} on ${date} at ${time} for ${guests} guests.`);
}

function toggleMenu() {
    document.querySelector('.navbar').classList.toggle('active');
}

</script>

</body>
</html>

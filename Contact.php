<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Athidi Restaurant</title>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="navbar.css">
</head>
<body>

<?php

$name = $email = $message = "";
$nameErr = $emailErr = $messageErr = "";
$isFormSubmitted = false;
$confirmationMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    } else {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    }

    if (empty($_POST["message"])) {
        $messageErr = "Message is required";
    } else {
        $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
    }

    if (empty($nameErr) && empty($emailErr) && empty($messageErr)) {
        $isFormSubmitted = true;
        $confirmationMessage = "Thank you, $name! Your message has been sent successfully.";

        $to = "info@restaurant.com";
        $subject = "New Contact Form Message from $name";
        $emailContent = "Name: $name\nEmail: $email\nMessage:\n$message";

        if (mail($to, $subject, $emailContent)) {
            $confirmationMessage .= " We will get back to you shortly.";
        } else {
            $confirmationMessage = "Sorry, there was an issue sending your message. Please try again.";
        }
    }
}
?>

<nav class="navbar">
        <div class="logo">
            <a href="Home.php">Athidi Restaurant</a>
        </div>
        <ul class="nav-links">
            <li><a href="Home.php">Home</a></li>
            <li><a href="Menu.php">Menu</a></li>
            <li><a href="Orders.php">Orders</a></li>
            <li><a href="Contact.php">Contact</a></li>
            <li><a href="Login.php">Login</a></li>
        </ul>
    </nav>

<div class="contact-container">
    <h2 class="contact-heading">Contact Us</h2>

    <?php if ($isFormSubmitted): ?>
        <p class="confirmation-message"><?= $confirmationMessage ?></p>
    <?php endif; ?>

    <div class="contact-info">
        <div class="contact-details">
            <h3>Our Address</h3>
            <p>123 Food Street</p>
            <p>Tanuku</p>
            <p>Phone: 123456789</p>
            <p>Email: info@restaurant.com</p>
        </div>

        <div class="contact-form-wrapper">
            <div class="contact-form">
                <h3>Get in Touch</h3>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($name) ?>" required>
                    <span class="error"><?= $nameErr ?></span>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
                    <span class="error"><?= $emailErr ?></span>

                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="4" required><?= htmlspecialchars($message) ?></textarea>
                    <span class="error"><?= $messageErr ?></span>
                    
                    <button type="submit">Send Message</button>
                </form>
            </div>
        </div>
    </div>

    <div class="location-section">
        <h3>Find Us Here</h3>
        <div class="map-container">
        <iframe class="gmap_iframe" style="width:100%; height:100%"
        src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=tanuku,athidhi Restaurant&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
        </div>
    </div>
</div>
</body>
</html>

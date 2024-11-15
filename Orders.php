<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_SESSION['orders'])) {
    $email = $_SESSION['user_email']; 
    $subject = "Order Details";
    
    $message = "Your selected items are:\n\n";
    foreach ($_SESSION['orders'] as $order) {
        $message .= htmlspecialchars($order['name']) . " - ₹" . number_format($order['price'], 2) . "\n";
    }

    $totalPrice = array_sum(array_column($_SESSION['orders'], 'price'));
    $message .= "\nTotal: ₹" . number_format($totalPrice, 2);

    $headers = "From: venkatsadhanala169@gmail.com";

    // Try sending the email
    if (mail($email, $subject, $message, $headers)) {
        echo "<p>Email sent successfully!</p>";
        unset($_SESSION['orders']); // Clear orders only if email sent successfully
    } else {
        echo "<p>Failed to send email. Check your server's mail configuration.</p>";
        error_log("Email failed to send to $email");
    }
}

// if (isset($_SESSION['user_email'])) {
//     $email = $_SESSION['user_email'];
// } else {
//     echo "<p>Please log in to view your orders.</p>";
//     exit;
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selected Items</title>
    <style>
        
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
}

h1 {
    text-align: center;
    color: #333;
    padding: 20px;
    background-color: #4CAF50;
    color: white;
    margin: 0;
}

h3 {
    text-align: center;
    color: #333;
    padding-top: 20px;
}

p {
    text-align: center;
    color: #777;
    font-size: 19px; 
}

ul {
    list-style-type: none;
    padding: 0;
    margin: 20px auto;
    max-width: 600px;
}

li {
    background-color: #fff;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    font-size: 19px; 
}

li:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}

.total {
    font-size: 24px; 
    font-weight: bold;
    color: #4CAF50;
    padding-top: 20px;
    text-align: center;
}

.order-btn {
    display: block;
    width: 200px;
    padding: 10px;
    margin: 20px auto;
    background-color: #ff6347;
    color: white;
    text-align: center;
    border: none;
    border-radius: 5px;
    font-size: 19px;
    cursor: pointer;
}

.order-btn:hover {
    background-color: #ff6347;
}
    </style>
    </style>
</head>
<body>
    <h1>Selected Items</h1>

    <?php if (!empty($_SESSION['orders'])): ?>
        <ul>
            <?php foreach ($_SESSION['orders'] as $order): ?>
                <li><?php echo htmlspecialchars($order['name']); ?> - ₹<?php echo number_format($order['price'], 2); ?></li>
            <?php endforeach; ?>
        </ul>
        <h3 class="total">Total: ₹<?php echo number_format(array_sum(array_column($_SESSION['orders'], 'price')), 2); ?></h3>
        <form method="POST">
            <button type="submit" class="order-btn">Place Order</button>
        </form>
    <?php else: ?>
        <p>No items selected yet.</p>
    <?php endif; ?>
</body>
</html>
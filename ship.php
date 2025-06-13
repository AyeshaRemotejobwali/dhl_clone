<?php
require_once 'db.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sender_name = $_POST['sender_name'] ?? '';
    $sender_address = $_POST['sender_address'] ?? '';
    $receiver_name = $_POST['receiver_name'] ?? '';
    $receiver_address = $_POST['receiver_address'] ?? '';
    if ($sender_name && $sender_address && $receiver_name && $receiver_address) {
        $tracking_number = str_pad(rand(0, 9999999999999999), 16, '0', STR_PAD_LEFT);
        $stmt = $pdo->prepare("INSERT INTO shipments (tracking_number, sender_name, sender_address, receiver_name, receiver_address, status, details) VALUES (?, ?, ?, ?, ?, 'Pending', 'Awaiting pickup')");
        try {
            $stmt->execute([$tracking_number, $sender_name, $sender_address, $receiver_name, $receiver_address]);
            $message = "Shipment created! Tracking Number: $tracking_number";
        } catch (PDOException $e) {
            $message = "Error creating shipment: " . $e->getMessage();
        }
    } else {
        $message = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DHL Clone - Ship</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; background-color: #f4f4f4; }
        header { background: #ffc107; color: #d80621; padding: 1rem; text-align: center; }
        nav { background: #d80621; padding: 1rem; }
        nav a { color: white; text-decoration: none; margin: 0 1rem; font-weight: bold; }
        nav a:hover { color: #ffc107; }
        .ship-section { max-width: 800px; margin: 2rem auto; background: white; padding: 2rem; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .ship-section h2 { color: #d80621; margin-bottom: 1rem; }
        .ship-form input, .ship-form textarea { width: 100%; padding: 0.5rem; margin-bottom: 1rem; border-radius: 5px; border: 1px solid #ccc; }
        .ship-form button { padding: 0.5rem 1rem; background: #d80621; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .message { color: #d80621; margin-bottom: 1rem; }
        footer { background: #333; color: white; text-align: center; padding: 1rem; margin-top: 2rem; }
    </style>
</head>
<body>
    <header>
        <h1>DHL Express Clone</h1>
    </header>
    <nav>
        <a href="#" onclick="navigate('index.php')">Home</a>
        <a href="#" onclick="navigate('ship.php')">Ship</a>
        <a href="#" onclick="navigate('track.php')">Track</a>
        <a href="#" onclick="navigate('contact.php')">Contact</a>
    </nav>
    <div class="ship-section">
        <h2>Create a Shipment</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form class="ship-form" method="POST">
            <input type="text" name="sender_name" placeholder="Sender Name" required>
            <textarea name="sender_address" placeholder="Sender Address" required></textarea>
            <input type="text" name="receiver_name" placeholder="Receiver Name" required>
            <textarea name="receiver_address" placeholder="Receiver Address" required></textarea>
            <button type="submit">Create Shipment</button>
        </form>
    </div>
    <footer>
        <p>© 2025 DHL Express Clone</p>
    </footer>
    <script>
        function navigate(url) {
            window.location.href = url;
        }
    </script>
</body>
</html>

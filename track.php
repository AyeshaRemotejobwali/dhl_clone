<?php
require_once 'db.php';
$message = '';
$tracking_result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tracking_number'])) {
    $tracking_number = $_POST['tracking_number'];
    if (preg_match('/^\d{10,16}$/', $tracking_number)) {
        $stmt = $pdo->prepare("SELECT * FROM shipments WHERE tracking_number = ?");
        $stmt->execute([$tracking_number]);
        $tracking_result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$tracking_result) {
            $message = "No shipment found with tracking number: $tracking_number";
        }
    } else {
        $message = "Please enter a valid 10-16 digit tracking number.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DHL Clone - Track Shipment</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; background-color: #f4f4f4; }
        header { background: #ffc107; color: #d80621; padding: 1rem; text-align: center; }
        nav { background: #d80621; padding: 1rem; }
        nav a { color: white; text-decoration: none; margin: 0 1rem; font-weight: bold; }
        nav a:hover { color: #ffc107; }
        .track-section { max-width: 800px; margin: 2rem auto; background: white; padding: 2rem; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .track-section h2 { color: #d80621; margin-bottom: 1rem; }
        .track-form input { padding: 0.5rem; width: 100%; max-width: 300px; border-radius: 5px; border: 1px solid #ccc; }
        .track-form button { padding: 0.5rem 1rem; background: #d80621; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .track-result { margin-top: 2rem; }
        .track-result p { margin-bottom: 0.5rem; }
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
    <div class="track-section">
        <h2>Track Your Shipment</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form class="track-form" method="POST">
            <input type="text" name="tracking_number" placeholder="Enter Tracking Number" required>
            <button type="submit">Track</button>
        </form>
        <?php if ($tracking_result): ?>
            <div class="track-result">
                <p><strong>Tracking Number:</strong> <?php echo htmlspecialchars($tracking_result['tracking_number']); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($tracking_result['status']); ?></p>
otek
                <p><strong>Sender:</strong> <?php echo htmlspecialchars($tracking_result['sender_name']); ?>, <?php echo htmlspecialchars($tracking_result['sender_address']); ?></p>
                <p><strong>Receiver:</strong> <?php echo htmlspecialchars($tracking_result['receiver_name']); ?>, <?php echo htmlspecialchars($tracking_result['receiver_address']); ?></p>
                <p><strong>Last Update:</strong> <?php echo date('F j, Y, H:i', strtotime($tracking_result['last_update'])); ?></p>
                <p><strong>Details:</strong> <?php echo htmlspecialchars($tracking_result['details']); ?></p>
            </div>
        <?php endif; ?>
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

<?php
require_once 'db.php';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message_text = $_POST['message'] ?? '';
    if ($name && $email && $message_text) {
        $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        try {
            $stmt->execute([$name, $email, $message_text]);
            $message = "Your message has been sent successfully!";
        } catch (PDOException $e) {
            $message = "Error sending message: " . $e->getMessage();
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
    <title>DHL Clone - Contact Us</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; background-color: #f4f4f4; }
        header { background: #ffc107; color: #d80621; padding: 1rem; text-align: center; }
        nav { background: #d80621; padding: 1rem; }
        nav a { color: white; text-decoration: none; margin: 0 1rem; font-weight: bold; }
        nav a:hover { color: #ffc107; }
        .contact-section { max-width: 800px; margin: 2rem auto; background: white; padding: 2rem; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .contact-section h2 { color: #d80621; margin-bottom: 1rem; }
        .contact-form input, .contact-form textarea { width: 100%; padding: 0.5rem; margin-bottom: 1rem; border-radius: 5px; border: 1px solid #ccc; }
        .contact-form button { padding: 0.5rem 1rem; background: #d80621; color: white; border: none; border-radius: 5px; cursor: pointer; }
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
    <div class="contact-section">
        <h2>Contact Us</h2>
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form class="contact-form" method="POST">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
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

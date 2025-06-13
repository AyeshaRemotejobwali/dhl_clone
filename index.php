<?php
require_once 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DHL Clone - Homepage</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; background-color: #f4f4f4; }
        header { background: #ffc107; color: #d80621; padding: 1rem; text-align: center; }
        header h1 { font-size: 2.5rem; }
        nav { background: #d80621; padding: 1rem; }
        nav a { color: white; text-decoration: none; margin: 0 1rem; font-weight: bold; }
        nav a:hover { color: #ffc107; }
        .hero { background: url('dhl-hero.jpg') center/cover; padding: 3rem; color: white; text-align: center; }
        .hero h2 { font-size: 2rem; margin-bottom: 1rem; }
        .hero button { padding: 0.5rem 1rem; background: #d80621; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .features { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; padding: 2rem; }
        .feature-card { background: white; border-radius: 5px; padding: 1rem; text-align: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); cursor: pointer; }
        .feature-card h3 { color: #d80621; margin-bottom: 0.5rem; }
        footer { background: #333; color: white; text-align: center; padding: 1rem; margin-top: 2rem; }
        @media (max-width: 768px) { .features { grid-template-columns: 1fr; } }
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
    <div class="hero">
        <h2>Ship Smarter with DHL</h2>
        <p>Fast, reliable, and global shipping solutions.</p>
        <button onclick="navigate('ship.php')">Start Shipping</button>
    </div>
    <div class="features">
        <div class="feature-card" onclick="navigate('ship.php')">
            <h3>Ship Now</h3>
            <p>Create and manage your shipments with ease.</p>
        </div>
        <div class="feature-card" onclick="navigate('track.php')">
            <h3>Track Shipment</h3>
            <p>Monitor your parcels in real-time.</p>
        </div>
        <div class="feature-card" onclick="navigate('contact.php')">
            <h3>Contact Us</h3>
            <p>Get support for all your shipping needs.</p>
        </div>
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

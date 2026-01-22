<?php include 'views/layout/header.php'; ?>
    <div class="container">
        <div class="welcome-section">
            <h1>Welcome, <?php echo $_SESSION['name']; ?></h1>
        </div>
        <div class="grid-cards">
            <div class="card">
                <h3>Browse</h3>
                <p>Find your dream home.</p>
                <a href="index.php?action=browse" class="btn">Browse Properties</a>
            </div>
            <div class="card">
                <h3>History</h3>
                <p>Check your bookings.</p>
                <a href="index.php?action=bookings" class="btn">My Bookings</a>
            </div>
            <div class="card">
                <h3>Profile</h3>
                <p>Update your details.</p>
                <a href="index.php?action=profile" class="btn">Settings</a>
            </div>
        </div>
    </div>
<?php include 'views/layout/footer.php'; ?>
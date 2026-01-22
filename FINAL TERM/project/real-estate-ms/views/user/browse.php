<?php include 'views/layout/header.php'; ?>
    <div class="container">
        <div class="welcome-section" style="text-align: center;">
            <h1>Browse Properties</h1>

            <form action="index.php" method="GET" style="margin-top: 15px; display: inline-flex; gap: 10px;">
                <input type="hidden" name="action" value="browse">
                <input type="text" name="search" placeholder="Search..." style="padding: 10px; width: 300px; border:none; border-radius: 4px;">
                <button type="submit" class="btn" style="background: #2c3e50;">Search</button>
            </form>
        </div>

        <div class="grid-cards">
            <?php if ($properties->num_rows > 0): ?>
                <?php while($row = $properties->fetch_assoc()): ?>
                    <div class="card">
                        <?php
                        $img = 'uploads/' . (!empty($row['property_image']) ? $row['property_image'] : 'default.jpg');
                        if (!file_exists($img)) { $img = 'uploads/default.jpg'; }
                        ?>

                        <img src="<?php echo $img; ?>" alt="Property Image">

                        <h3><?php echo htmlspecialchars($row['property_name']); ?></h3>
                        <p><strong>Location:</strong> <?php echo htmlspecialchars($row['location']); ?></p>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <h2 style="color: #27ae60; margin: 10px 0;">$<?php echo number_format($row['property_price']); ?></h2>

                        <?php if (isset($my_bookings[$row['property_id']])): ?>
                            <button class="btn" style="background: #ccc; cursor: not-allowed;" disabled>Request Sent</button>
                        <?php else: ?>
                            <form action="index.php?action=book" method="POST">
                                <input type="hidden" name="prop_id" value="<?php echo $row['property_id']; ?>">
                                <button type="submit" class="btn">Request Booking</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No properties found.</p>
            <?php endif; ?>
        </div>
    </div>
<?php include 'views/layout/footer.php'; ?>
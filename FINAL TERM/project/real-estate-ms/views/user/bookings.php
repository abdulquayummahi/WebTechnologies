<?php include 'views/layout/header.php'; ?>

    <div class="container">
        <h2>My Booking History</h2>

        <?php if ($bookings->num_rows > 0): ?>
            <table>
                <thead>
                <tr>
                    <th>Property Name</th>
                    <th>Price</th>
                    <th>Date Requested</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php while($row = $bookings->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['property_name']); ?></td>

                        <td>$<?php echo number_format($row['property_price']); ?></td>

                        <td><?php echo date("M d, Y", strtotime($row['booking_date'])); ?></td>

                        <td>
                        <span class="status <?php echo strtolower($row['status']); ?>">
                            <?php echo $row['status']; ?>
                        </span>
                        </td>

                        <td>
                            <?php if ($row['status'] == 'Pending'): ?>
                                <form action="index.php?action=cancel" method="POST" onsubmit="return confirm('Are you sure you want to cancel this request?');">
                                    <input type="hidden" name="booking_id" value="<?php echo $row['booking_id']; ?>">
                                    <button type="submit" class="btn-cancel">Cancel Request</button>
                                </form>
                            <?php else: ?>
                                <span style="color: #aaa; font-size: 12px;">No Action</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="card" style="text-align: center;">
                <p>You haven't booked any properties yet.</p>
                <a href="index.php?action=browse" class="btn">Browse Properties</a>
            </div>
        <?php endif; ?>
    </div>

<?php include 'views/layout/footer.php'; ?>
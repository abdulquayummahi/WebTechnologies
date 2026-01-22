<?php include 'views/layout/header.php'; ?>
    <div class="container">
        <h2>Update Profile</h2>
        <?php echo isset($message) ? $message : ''; ?>

        <form action="index.php?action=profile" method="POST" class="profile-card">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($user_data['name']); ?>" required>
            </div>

            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($user_data['phone']); ?>" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" value="<?php echo htmlspecialchars($user_data['password']); ?>" required>
            </div>

            <div class="form-group">
                <label>Security Answer</label>
                <input type="text" name="security_answer" value="<?php echo htmlspecialchars($user_data['security_answer']); ?>" required>
            </div>
            <button type="submit" class="btn">Save Changes</button>
        </form>
    </div>
<?php include 'views/layout/footer.php'; ?>
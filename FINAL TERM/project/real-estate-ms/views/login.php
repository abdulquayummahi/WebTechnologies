<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login - Real Estate MS</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { display: flex; justify-content: center; align-items: center; height: 100vh; background: linear-gradient(135deg, #3498db, #8e44ad); }
        .login-card { background: white; padding: 40px; border-radius: 10px; width: 350px; text-align: center; box-shadow: 0 5px 15px rgba(0,0,0,0.2); }
        input, select, button { width: 100%; padding: 12px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ddd; }
        button { background: #3498db; color: white; border: none; font-weight: bold; cursor: pointer; }
        button:hover { background: #2980b9; }
    </style>
</head>
<body>
<div class="login-card">
    <h2>EstatePro Login</h2>
    <form action="index.php?action=login_submit" method="POST">
        <select name="role" required>
            <option value="" disabled selected>Select Role</option>
            <option value="user">User / Tenant</option>
            <option value="owner">Property Owner</option>
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
        </select>
        <input type="text" name="id" placeholder="User ID (e.g., u-101)" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
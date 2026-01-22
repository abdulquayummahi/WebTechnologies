<?php
session_start();

// 1. Load Configuration
include_once 'config/Database.php';

// 2. Load ALL Controllers
include_once 'controllers/AuthController.php';
include_once 'controllers/UserController.php';
include_once 'controllers/OwnerController.php';
include_once 'controllers/StaffController.php';
include_once 'controllers/AdminController.php';

// 3. Handle Public Routes (Login/Logout)
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

if ($action == 'login') {
    include 'views/login.php';
    exit();
}
if ($action == 'login_submit') {
    $auth = new AuthController();
    $auth->login();
    exit();
}
if ($action == 'logout') {
    $auth = new AuthController();
    $auth->logout();
    exit();
}

// 4. Security Check (Private Routes)
// If the user is not logged in, force them back to login page
if (!isset($_SESSION['role'])) {
    header("Location: index.php?action=login");
    exit();
}

// 5. Initialize the Correct Controller based on Role
$role = $_SESSION['role'];
$controller = null;

switch ($role) {
    case 'user':
        $controller = new UserController();
        break;
    case 'owner':
        $controller = new OwnerController();
        break;
    case 'staff':
        $controller = new StaffController();
        break;
    case 'admin':
        $controller = new AdminController();
        break;
    default:
        // If role is invalid, destroy session and go to login
        session_destroy();
        header("Location: index.php");
        exit();
}

// 6. Execute the Requested Action (Dynamic Routing)
// This automatically finds 'accept_booking' in the controller and runs it.
if ($controller && method_exists($controller, $action)) {
    $controller->$action();
} else {
    // Fallback: If action doesn't exist, go to dashboard
    $controller->dashboard();
}
?>
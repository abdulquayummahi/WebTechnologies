<?php
include_once 'config/Database.php';
include_once 'models/UserModel.php';

class UserController {
    private $model;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->model = new UserModel($db);
    }

    public function dashboard() {
        include 'views/user/dashboard.php';
    }

    public function browse() {
        $search = isset($_GET['search']) ? $_GET['search'] : "";
        $properties = $this->model->getAvailableProperties($search);
        $my_bookings = $this->model->getUserBookingStatus($_SESSION['user_id']);
        include 'views/user/browse.php';
    }

    public function book() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->bookProperty($_POST['prop_id'], $_SESSION['user_id']);
            echo "<script>alert('Success! Your booking request has been sent.'); window.location.href='index.php?action=browse';</script>";
        }
    }

    // 👇 FIXED: Renamed from 'myBookings' to 'bookings' to match ?action=bookings
    public function bookings() {
        $bookings = $this->model->getMyBookings($_SESSION['user_id']);
        include 'views/user/bookings.php';
    }

    public function cancel() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $success = $this->model->cancelBooking($_POST['booking_id'], $_SESSION['user_id']);
            if ($success) {
                echo "<script>alert('Request Cancelled Successfully.'); window.location.href='index.php?action=bookings';</script>";
            } else {
                echo "<script>alert('Cannot cancel: Booking is approved or invalid.'); window.location.href='index.php?action=bookings';</script>";
            }
        }
    }

    public function profile() {
        $message = "";
        $user_data = $this->model->getUserDetails($_SESSION['user_id']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $updated = $this->model->updateProfile(
                $_SESSION['user_id'],
                $_POST['name'],
                $_POST['phone'],
                $_POST['password'],
                $_POST['security_answer']
            );

            if ($updated) {
                $_SESSION['name'] = $_POST['name'];
                $message = "<div class='alert success'>Profile Updated Successfully!</div>";
                $user_data = $this->model->getUserDetails($_SESSION['user_id']);
            } else {
                $message = "<div class='alert error'>Update Failed.</div>";
            }
        }

        include 'views/user/profile.php';
    }
}
?>
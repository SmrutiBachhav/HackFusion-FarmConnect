<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and get data from URL query parameters
    $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_SPECIAL_CHARS);
    $login_input = filter_input(INPUT_POST, "login_input", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
}

if (empty($role) || empty($login_input) || empty($password)) {
    echo "<script>alert('Please enter requested details.'); window.history.back();</script>";
} else {
    if ($role == "farmer") {
        $sql = "SELECT * FROM farm_owners WHERE name = '$login_input' OR contact_no = '$login_input' OR email = '$login_input'";
        $result = mysqli_query($conn, $sql);
    } else {
        $sql = "SELECT * FROM workers WHERE name = '$login_input' OR contact_no = '$login_input' OR email = '$login_input'";
        $result = mysqli_query($conn, $sql);
    }

    if ($result) {
        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['user_id'] = $row['id']; // Save user session
                echo "<script>alert('Login successful as $role!'); window.location.href='index.html';</script>";
            } else {
                echo "<script>alert('Incorrect password!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('User not found!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Database query failed!'); window.history.back();</script>";
    }

    mysqli_close($conn);
}
?>

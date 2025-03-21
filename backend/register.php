<?php
// Make sure you have a valid database connection
include("database.php");
// $conn = mysqli_connect("localhost", "username", "password", "database_name");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form input
    $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_SPECIAL_CHARS);
    $fullname = filter_input(INPUT_POST, "fullname", FILTER_SANITIZE_SPECIAL_CHARS);
    $address = filter_input(INPUT_POST, "addr", FILTER_SANITIZE_SPECIAL_CHARS);
    $contact_no = filter_input(INPUT_POST, "contact", FILTER_SANITIZE_SPECIAL_CHARS); 
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

    // Check for empty required fields
    if (empty($fullname) || empty($contact_no) || empty($address) || empty($password) || empty($confirmPassword)) {
        echo "<script>alert('Please enter all details!'); window.history.back();</script>";
        exit(); // Stop further execution if fields are empty
    }

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit(); // Stop execution if passwords don't match
    }

    // Hash the password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Insert into the appropriate table based on role
    if ($role == "farmer") {
        $sql = "INSERT INTO farm_owners (name, contact_no, email, addr, password) VALUES (?, ?, ?, ?, ?)";
    } else {
        $sql = "INSERT INTO workers (name, contact_no, email, addr, password) VALUES (?, ?, ?, ?, ?)";
    }

    // Prepare the SQL statement
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        echo "<script>alert('Failed to prepare SQL statement.'); window.history.back();</script>";
        exit();
    }

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "sssss", $fullname, $contact_no, $email, $address, $hash);

    // Execute the prepared statement
    $result = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if ($result) {
        echo "<script>alert('Registration successful!');</script>";
    } else {
        echo "<script>alert('Registration failed! Email might already be registered.'); window.history.back();</script>";
    }

    // Close the prepared statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

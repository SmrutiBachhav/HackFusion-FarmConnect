<!-- <?php
// include("database.php");

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Sanitize and get data from URL query parameters
//     $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_SPECIAL_CHARS);
//     $login_input = filter_input(INPUT_POST, "login_input", FILTER_SANITIZE_SPECIAL_CHARS);
//     $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
// }

// if (empty($role) || empty($login_input) || empty($password)) {
//     echo "<script>alert('Please enter requested details.'); window.history.back();</script>";
// } else {
//     if ($role == "farmer") {
//         $sql = "SELECT * FROM farm_owners WHERE name = '$login_input' OR contact_no = '$login_input' OR email = '$login_input'";
//         $result = mysqli_query($conn, $sql);
//     } else {
//         $sql = "SELECT * FROM workers WHERE name = '$login_input' OR contact_no = '$login_input' OR email = '$login_input'";
//         $result = mysqli_query($conn, $sql);
//     }

//     if ($result) {
//         if ($row = mysqli_fetch_assoc($result)) {
//             if (password_verify($password, $row['password'])) {
//                 session_start();
//                 $_SESSION['user_id'] = $row['id']; // Save user session
//                 // if($role == "farmer"){
//                     echo "<script>alert('Login successful as $role!'); window.location.href='farmer_dashboard.html';</script>";
//                 // }
//                 // else{
//                 //     echo "<script>alert('Login successful as $role!'); window.location.href='index.html';</script>";
//                 // }
//             } else {
//                 echo "<script>alert('Incorrect password!'); window.history.back();</script>";
//             }
//         } else {
//             echo "<script>alert('User not found!'); window.history.back();</script>";
//         }
//     } else {
//         echo "<script>alert('Database query failed!'); window.history.back();</script>";
//     }

//     mysqli_close($conn);
// }
//?> -->

<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_SPECIAL_CHARS);
    $login_input = filter_input(INPUT_POST, "login_input", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

    if (empty($role) || empty($login_input) || empty($password)) {
        echo "<script>alert('Please enter all requested details.'); window.history.back();</script>";
        exit();
    }

    // Select query based on role
    $table = ($role == "farmer") ? "farm_owners" : "workers";
    $sql = "SELECT * FROM $table WHERE name = ? OR contact_no = ? OR email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $login_input, $login_input, $login_input);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['user_id'] = $row['id'];

            // Redirect URL based on role
            $redirect_url = ($role == "farmer") ? "../frontend/farmer_dashboard.html" : "../frontend/worker_dashboard.html";
            echo "<script>alert('Login successful as $role!'); window.location.href='$redirect_url';</script>";
        } else {
            echo "<script>alert('Incorrect password!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('User not found!'); window.history.back();</script>";
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

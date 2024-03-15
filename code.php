<?php
session_start();
require "connection.php";
// Login
if (isset($_POST['LogInBtn'])) {
    $email = $_POST['email'];
    $password = $_POST['password']; // Remove md5 function
    $role = $_POST['role'];
    $code = $_POST['code'];

    if (empty($email)) {
        $_SESSION['status'] = "Email is required to fill up!";
        $_SESSION['status_code'] = "error";
        header('Location: log-in.php');
        exit();
    } elseif (empty($password)) {
        $_SESSION['status'] = "Password is required to fill up!";
        $_SESSION['status_code'] = "error";
        header('Location: log-in.php');
        exit();
    } else {
        if ($role == 'Customer') {
            $select_customer = "SELECT * FROM customer WHERE email='$email' LIMIT 1";
            $select_customer_run = mysqli_query($con, $select_customer);

            if ($select_customer_run) {
                $row = mysqli_fetch_assoc($select_customer_run);

                if ($row && password_verify($password, $row['password'])) { // Use password_verify instead of ($password) == $row['password']
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['customer_id'] = $row['customer_id'];
                    $_SESSION['status'] = "Welcome Customer!";
                    $_SESSION['status_code'] = "success";
                    echo '<script>window.location.href="customer/available-schedule.php";</script>';
                    exit();
                } else {
                    $_SESSION['status'] = "Incorrect Password";
                    $_SESSION['status_code'] = "error";
                    header("Location: log-in.php");
                    exit();
                }
            } else {
                $_SESSION['status'] = "Email Not Found.";
                $_SESSION['status_code'] = "error";
                header("Location: log-in.php");
                exit();
            }
        } elseif ($role == 'Admin') {
            // Check code in the database
            $check_code = "SELECT * FROM resortcode WHERE code = '$code' LIMIT 1";
            $check_code_run = mysqli_query($con, $check_code);

            if ($check_code_run && mysqli_num_rows($check_code_run) > 0) {
                if (empty($code)) {
                    $_SESSION['status'] = "Code is required to fill up!";
                    $_SESSION['status_code'] = "error";
                    header("Location: log-in.php");
                    exit();
                }

                $select_admin = "SELECT * FROM admin WHERE email='$email' LIMIT 1";
                $select_admin_run = mysqli_query($con, $select_admin);

                if ($select_admin_run) {
                    $row = mysqli_fetch_assoc($select_admin_run);

                    if ($row && password_verify($password, $row['password'])) { // Use password_verify instead of $password == $row['password']
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['role'] = $row['role'];
                        $_SESSION['admin_id'] = $row['admin_id'];
                        $_SESSION['status'] = "Welcome to ADMIN!";
                        $_SESSION['status_code'] = "success";
                        header('Location: admin/dashboard.php');
                        exit();
                    } else {
                        $_SESSION['status'] = "Incorrect Password";
                        $_SESSION['status_code'] = "error";
                        header("Location: log-in.php");
                        exit();
                    }
                } else {
                    $_SESSION['status'] = "Email Not Found";
                    $_SESSION['status_code'] = "error";
                    header("Location: log-in.php");
                    exit();
                }
            } else {
                $_SESSION['status'] = "Code not found";
                $_SESSION['status_code'] = "error";
                header('Location: log-in.php');
                exit();
            }
        } else {
            $_SESSION['status'] = "Something is wrong in Role.";
            $_SESSION['status_code'] = "error";
            header('Location: log-in.php');
            exit();
        }
    }
}


// Register Account
if (isset($_POST['SignUpBtn'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $cpassword = password_hash($_POST['cpassword'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $code = $_POST['code'];

    // Customer
    if ($role == 'Customer') {
        // check email
        $check_email = "SELECT * FROM customer WHERE email = ?";
        $stmt_check_email = mysqli_prepare($con, $check_email);
        mysqli_stmt_bind_param($stmt_check_email, "s", $email);
        mysqli_stmt_execute($stmt_check_email);
        $check_email_result = mysqli_stmt_get_result($stmt_check_email);

        if (mysqli_num_rows($check_email_result) > 0) {
            $_SESSION['status'] = "Email is already used!";
            $_SESSION['status_code'] = "error";
            header('Location: sign-up.php');
            exit();
        } else {
            if (password_verify($_POST['password'], $cpassword)) {
                $insert_customer = "INSERT INTO customer (firstname, lastname, number, email, password, cpassword) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt_insert_customer = mysqli_prepare($con, $insert_customer);
                mysqli_stmt_bind_param($stmt_insert_customer, "ssssss", $firstname, $lastname, $number, $email, $password, $cpassword);
                $insert_customer_run = mysqli_stmt_execute($stmt_insert_customer);

                if ($insert_customer_run) {
                    $_SESSION['status'] = "You have successfully registered";
                    $_SESSION['status_code'] = "success";
                    header('Location: log-in.php');
                    exit();
                } else {
                    $_SESSION['status'] = "There's an error in registration.";
                    $_SESSION['status_code'] = "error";
                    header('Location: sign-up.php');
                    exit();
                }
            } else {
                $_SESSION['status'] = "Passwords didn't match!";
                $_SESSION['status_code'] = "error";
                header('Location: sign-up.php');
                exit();
            }
        }
    } elseif ($role == 'Admin') {
        // Check email
        $check_email = "SELECT * FROM admin WHERE email = ?";
        $stmt_check_email = mysqli_prepare($con, $check_email);
        mysqli_stmt_bind_param($stmt_check_email, "s", $email);
        mysqli_stmt_execute($stmt_check_email);
        $check_email_result = mysqli_stmt_get_result($stmt_check_email);

        if (mysqli_num_rows($check_email_result) > 0) {
            $_SESSION['status'] = "Email is already used";
            $_SESSION['status_code'] = "error";
            header('Location: sign-up.php');
            exit();
        } else {
            // Check code in the database
            $check_code = "SELECT * FROM resortcode WHERE code = ?";
            $stmt_check_code = mysqli_prepare($con, $check_code);
            mysqli_stmt_bind_param($stmt_check_code, "s", $code);
            mysqli_stmt_execute($stmt_check_code);
            $check_code_result = mysqli_stmt_get_result($stmt_check_code);

            if ($check_code_result && mysqli_num_rows($check_code_result) > 0) {
                // Check if passwords match
                if (password_verify($_POST['password'], $cpassword)) {
                    $insert_admin = "INSERT INTO admin (firstname, lastname, email, password, cpassword) VALUES (?, ?, ?, ?, ?)";
                    $stmt_insert_admin = mysqli_prepare($con, $insert_admin);
                    mysqli_stmt_bind_param($stmt_insert_admin, "sssss", $firstname, $lastname, $email, $password, $cpassword);
                    $insert_admin_run = mysqli_stmt_execute($stmt_insert_admin);

                    if ($insert_admin_run) {
                        $_SESSION['status'] = "You have successfully registered";
                        $_SESSION['status_code'] = "success";
                        header('Location: log-in.php');
                        exit();
                    } else {
                        $_SESSION['status'] = "There's an error in registration.";
                        $_SESSION['status_code'] = "error";
                        header('Location: log-in.php');
                        exit();
                    }
                } else {
                    $_SESSION['status'] = "Passwords didn't match!";
                    $_SESSION['status_code'] = "error";
                    header('Location: log-in.php');
                    exit();
                }
            } else {
                $_SESSION['status'] = "Code not found";
                $_SESSION['status_code'] = "error";
                header('Location: log-in.php');
                exit();
            }
        }
    }
}



// end






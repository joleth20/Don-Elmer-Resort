<?php
session_start();
require "connection.php";
include('includes/scripts.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Sending link
if (isset($_POST['password_reset_link'])) {
    $email = $_POST['email'];
    $role = $_POST['role'];
    $token = md5(rand());

    // Check if the email exists in the 'customer' table

    if ($role == 'Customer') {
        $check_email = "SELECT email FROM customer WHERE email = '$email' LIMIT 1";
        $check_email_run = mysqli_query($con, $check_email);

        if (mysqli_num_rows($check_email_run) > 0) {

            $row = mysqli_fetch_array($check_email_run);
            $get_email = $row['email'];
            $get_fname = $row['firstname'];
            $get_lname = $row['lastname'];

            $full_name = $get_fname . ' ' . $get_lname;

            $update_token = "UPDATE customer SET verify_token='$token' WHERE email = '$get_email' LIMIT 1";
            $update_token_run = mysqli_query($con, $update_token);

            if (!$update_token_run) {
                $_SESSION['message'] = "Error: " . mysqli_error($con);
            }

            if ($update_token_run) {
                try {
                    $mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'donelmerresort.information@gmail.com';
                    $mail->Password = 'mbfauhujioyvlplt';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('donelmerresort.information@gmail.com');
                    $mail->addAddress($get_email);
                    $mail->isHTML(true);
                    $mail->Subject = "Don Elemer's - Reset Password";

                    $mail->Body = "
                    <html>
                        <head>
                        </head>
                        <body>
                              <h2>Dear $full_name,</h2>
                      <p>We trust this message finds you well. You are receiving this formal communication as a result of a recent request to reset the password for your account in the Don Elmer Resort.</p>
                    <p>If you have not initiated this action, kindly disregard this email.</p>
                     <p>To proceed with the password reset, kindly click the following link: 
                        <a href='/Don-Elmer-Resort/password-change.php?email=$get_email&role=$role&token=$token'>Click Me</a>
                            <p>Best regards,<br>
                     <p>Don Elemer's Resort</p>
                        </body>
                    </html>
                    ";

                    $mail->send();

                    $_SESSION['status'] = "We email  you a password reset link.";
                    $_SESSION['status_code'] = "success";
                    echo '<script>window.location.href = "password-reset.php";</script>';
                    exit();
                } catch (Exception $e) {
                    $_SESSION['message'] = "Email could not be sent. " . $mail->ErrorInfo;
                    echo '<script>window.location.href = "password-reset.php";</script>';
                    exit();
                }
            } else {
                $_SESSION['message'] = "Something went wrong." . mysqli_error($con);
                echo '<script>window.location.href = "password-reset.php";</script>';
                exit();
            }
        } else {
            $_SESSION['message'] = "No Email Found.";
            echo '<script>window.location.href = "password-reset.php";</script>';
            exit();
        }
    } elseif ($role == 'Admin') {
        $check_email = "SELECT email FROM admin WHERE email = '$email' LIMIT 1";
        $check_email_run = mysqli_query($con, $check_email);

        if (mysqli_num_rows($check_email_run) > 0) {
            $row = mysqli_fetch_array($check_email_run);
            $get_email = $row['email'];

            $update_token = "UPDATE `admin` SET `verify_token`='$token' WHERE `email` = '$get_email' LIMIT 1";
            $update_token_run = mysqli_query($con, $update_token);

            if ($update_token_run) {
                try {
                    $mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'donelmerresort.information@gmail.com';
                    $mail->Password = 'mbfauhujioyvlplt';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('donelmerresort.information@gmail.com');
                    $mail->addAddress($get_email);
                    $mail->isHTML(true);
                    $mail->Subject = "Don Elemer's - Reset Password";

                    $mail->Body = "
                    <html>
                        <head>
                        </head>
                        <body>
                         <h2>Dear $email,</h2>
                      <p>We trust this message finds you well. You are receiving this formal communication as a result of a recent request to reset the password for your account in the Don Elmer.</p>
                    <p>If you have not initiated this action, kindly disregard this email.</p>
                     <p>To proceed with the password reset, kindly click the following link: 
                        <a href=' /Don-Elmer-Resort/password-change.php?email=$get_email&role=$role&token=$token'>Click Me</a>
                          <p>Best regards,<br>
                     <p>Don Elemer's Resort</p>
                        </body>
                    </html>
                    ";

                    $mail->send();

                    $_SESSION['status'] = "We email  you a password reset link.";
                    $_SESSION['status_code'] = "success";
                    echo '<script>window.location.href = "password-reset.php";</script>';

                    exit();
                } catch (Exception $e) {
                    $_SESSION['status'] = "Email could not be sent. " . $mail->ErrorInfo;
                    $_SESSION['status_code'] = "error";
                    echo '<script>window.location.href = "password-reset.php";</script>';
                    exit();
                }
            } else {
                $_SESSION['status'] = "Something went wrong." . mysqli_error($con);
                $_SESSION['status_code'] = "error";
                echo '<script>window.location.href = "password-reset.php";</script>';
                exit();
            }
        } else {
            $_SESSION['status'] = "No Email Found.";
            $_SESSION['status_code'] = "error";
            echo '<script>window.location.href = "password-reset.php";</script>';
            exit();
        }
    } else {
        $_SESSION['status'] = "There's an error in role.";
        $_SESSION['status_code'] = "error";
        echo '<script>window.location.href = "password-reset.php";</script>';
        exit();
    }
}


// Updating password
if (isset($_POST['password_update'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $role = mysqli_real_escape_string($con, $_POST['role']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
    $token = mysqli_real_escape_string($con, $_POST['password_token']);

    if (!empty($token)) {

        if (!empty($email) && !empty($new_password) && !empty($confirm_password)) {

            // Check Role
            if ($role == 'Customer') {
                // Checking token if valid or not
                $check_token = "SELECT verify_token FROM customer WHERE verify_token= '$token' LIMIT 1";
                $check_token_run = mysqli_query($con, $check_token);

                if (mysqli_num_rows($check_token_run) > 0) {

                    if ($new_password == $confirm_password) {
                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                        $update_password = "UPDATE customer SET password='$hashed_password', cpassword= '$hashed_password' WHERE verify_token = '$token' LIMIT 1";
                        $update_password_run = mysqli_query($con, $update_password);

                        if ($update_password_run) {

                            $new_token = md5(rand());

                            $update_to_new_token = "UPDATE customer SET verify_token = '$new_token' WHERE verify_token = '$token' LIMIT 1";
                            $update_to_new_token_run = mysqli_query($con, $update_to_new_token);

                            $_SESSION['status'] = "Password Successfully Updated!";
                            $_SESSION['status_code'] = "success";
                            header("Location: log-in.php");
                            exit();
                        } else {
                            $_SESSION['status'] = "Password did not update. Something went wrong.";
                            $_SESSION['status_code'] = "error";
                            header("Location: password-change.php?token=$token&email=$email&role=$role");
                            exit();
                        }
                    } else {
                        $_SESSION['status'] = "Password and Confirm Password does not match.";
                        $_SESSION['status_code'] = "error";
                        header("Location: password-change.php?token=$token&email=$email&role=$role");
                        exit();
                    }
                } else {
                    $_SESSION['status'] = "Invalid Token.";
                    $_SESSION['status_code'] = "error";
                    header("Location: password-change.php?token=$token&email=$email&role=$role");
                    exit();
                }
            } elseif ($role == 'Admin') {
                // Checking token if valid or not
                $check_token = "SELECT verify_token FROM admin WHERE verify_token= '$token' LIMIT 1";
                $check_token_run = mysqli_query($con, $check_token);

                if (mysqli_num_rows($check_token_run) > 0) {

                    if ($new_password == $confirm_password) {
                        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                        $update_password = "UPDATE admin SET password='$hashed_password' WHERE verify_token = '$token' LIMIT 1";
                        $update_password_run = mysqli_query($con, $update_password);

                        if ($update_password_run) {

                            $new_token = md5(rand());

                            $update_to_new_token = "UPDATE admin SET verify_token = '$new_token' WHERE verify_token = '$token' LIMIT 1";
                            $update_to_new_token_run = mysqli_query($con, $update_to_new_token);

                            $_SESSION['status'] = "Password Successfully Updated!";
                            $_SESSION['status_code'] = "success";
                            header("Location: log-in.php");
                            exit();
                        } else {
                            $_SESSION['status'] = "Password did not update. Something went wrong.";
                            $_SESSION['status_code'] = "error";
                            header("Location: password-change.php?token=$token&email=$email&role=$role");
                            exit();
                        }
                    } else {
                        $_SESSION['status'] = "Password and Confirm Password does not match.";
                        $_SESSION['status_code'] = "error";
                        header("Location: password-change.php?token=$token&email=$email&role=$role");
                        exit();
                    }
                } else {
                    $_SESSION['status'] = "Invalid Token.";
                    $_SESSION['status_code'] = "error";
                    header("Location: password-change.php?token=$token&email=$email&role=$role");
                    exit();
                }
            } else {
                $_SESSION['status'] = "Invalid Role.";
                $_SESSION['status_code'] = "error";
                header("Location: password-change.php?token=$token&email=$email&role=$role");
                exit();
            }
        } else {
            $_SESSION['status'] = "All fields are required.";
            $_SESSION['status_code'] = "error";
            header("Location: password-change.php?token=$token&email=$email&role=$role");
            exit();
        }
    } else {
        $_SESSION['status'] = "No Token Available";
        $_SESSION['status_code'] = "error";
        header("Location: password-change.php");
        exit();
    }
}

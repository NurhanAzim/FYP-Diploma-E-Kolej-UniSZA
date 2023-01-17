<?php
session_start();
include('includes/dbConn.php');
require_once __DIR__ . '/assets/composer/vendor/autoload.php';

if (isset($_POST['register_student-btn'])) {
    $formData = file_get_contents('php://input');
    parse_str($formData, $data);

    $username = mysqli_real_escape_string($conn, $data['username']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $password = mysqli_real_escape_string($conn, $data['password']);
    $confirm_password = mysqli_real_escape_string($conn, $data['cpassword']);
    $program = mysqli_real_escape_string($conn, $data['program']);
    $year = mysqli_real_escape_string($conn, $data['year']);


    if ($password == $confirm_password) {

        $checkemail = "SELECT `email` FROM `tbl_student` WHERE `email` = '$email'";
        $checkemail_run = $conn->query($checkemail);

        if ($checkemail_run && mysqli_num_rows($checkemail_run) > 0) { //check duplicate email

            $_SESSION['alert'] = "Email sudah pernah didaftarkan sebelum ini";
            header("Location: student-register.php");
            exit(0);
        } else {
            // Generate a truly random 6-digit ID
            $randomBytes = random_bytes(4);
            $userId = unpack('N', $randomBytes)[1] & 0x7FFFFFFF;
            $userId = $userId % 100000;

            $studentQuery = "INSERT into tbl_student(`userId`, `email`, `username`, `password`, `program`, `year`) values ('$userId', '$email', '$username', '$password', '$program', '$year')";
            $studentQuery_run = $conn->query($studentQuery);

            if ($studentQuery_run) {
                $_SESSION['alert'] = "Pendaftaran akaun berjaya";
                header("Location: student-login.php");
                exit(0);
            } else {
                $_SESSION['alert'] = "ralat";
                header("Location: student-register.php");
                exit(0);
            }
        }
    } else {
        $_SESSION['alert'] = "Kata laluan tidak sama";
        header("Location: student-register.php");
        exit(0);
    }
}

if (isset($_POST['login_student-btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM `tbl_student` WHERE `email`='$email' AND `password`='$password' LIMIT 1";
    $query_run = $conn->query($query);

    if (mysqli_num_rows($query_run) > 0) {

        foreach ($query_run as $data) {
            $userId = $data['userId'];
            $username = $data['username'];
            $email = $data['email'];
        }
        $_SESSION['auth'] = true;
        $_SESSION['auth_user'] = [
            'userId' => $userId,
            'username' => $username,
            'email' => $email
        ];
        $_SESSION['alert'] = "Log masuk berjaya";
        header("Location: home.php");
        exit(0);
    } else {
        $_SESSION['alert'] = "Email atau kata laluan salah";
        header("Location: student-login.php");
        exit(0);
    }
}

if (isset($_POST['student_edit-btn'])) {

    if (empty($_POST['username']) && empty($_POST['email'])) {
        header("Location: admin-edit.php");
        exit(0);
    }
    $adminId = (string) ['auth_user']['userId'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $checkemail = "SELECT `email` FROM `admin` WHERE `email` = '$email'";
    $checkemail_run = $conn->query($checkemail);

    if ($checkemail_run && mysqli_num_rows($checkemail_run) > 0) { //check duplicate email
        $_SESSION['message'] = "Email sudah pernah didaftarkan sebelum ini";
        header("Location: admin-edit.php");
        exit(0);
    }
    $query = "UPDATE `admin` SET `username`='$username', `email`='$email' WHERE `adminId`='$adminId'";
    $query_run = $conn->query($query);

    if ($query_run) {
        $_SESSION['message'] = "Pendaftaran akaun berjaya";
        header("Location: admin-list.php");
        exit(0);
    } else {
        $_SESSION['message'] = "ralat";
        header("Location: admin-list.php");
        exit(0);
    }
}

if (isset($_POST['student_delete-btn'])) {
    $adminId = mysqli_real_escape_string($conn, $_POST['delete_room-btn']);
    $query = "DELETE FROM `admin` WHERE `adminId`='$adminId'";
    $query_run = $conn->query($query);

    if ($query_run) {
        $_SESSION['alert'] = "Akaun berjaya dihapuskan";
        header("Location: admin-list.php");
        exit(0);
    } else {
        $_SESSION['alert'] = "Akaun gagal dihapuskan";
        header("Location: admin-list.php");
        exit(0);
    }
}

if (isset($_POST['profile_edit-btn'])) {

    $userId = (string) $_SESSION['auth_user']['userId'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);

    $query = "UPDATE `tbl_student` SET `username`='$username', `program`='$program', `year`='$year' WHERE `userId`='$userId'";
    $query_run = $conn->query($query);

    if ($query_run) {
        $_SESSION['auth_user']['username'] = $username;
        $_SESSION['alert'] = "Maklumat profil berjaya dikemaskini";
        header("Location: home.php");
        exit(0);
    } else {
        $_SESSION['alert'] = "ralat";
        header("Location: home.php");
        exit(0);
    }
}

if (isset($_POST['change_pass-btn'])) {
    $userId = (string) $_SESSION['auth_user']['userId'];
    $old_password = mysqli_real_escape_string($conn, $_POST['oldPass']);
    $new_password = mysqli_real_escape_string($conn, $_POST['newPass']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirmPass']);

    if ($new_password == $confirm_password) {
        $checkPass = "SELECT * FROM `tbl_student` WHERE `userId`='$userId' AND `password`='$oldPass'";
        $checkPass_run = $conn->query($checkPass);

        if (mysqli_num_rows($checkPass_run) < 0) {
            $_SESSION['alert'] = "Kata laluan semasa tidak sepadan";
            header("Location: student-changePass.php");
            exit(0);
        } else {
            $query = "UPDATE `tbl_student` SET `password`='$new_password' WHERE `userId`='$userId'";
            $query_run = $conn->query($query);

            if (!$query_run) {
                $_SESSION['alert'] = "Kata laluan gagal dikemaskini";
                header("Location: student-changePass.php");
                exit(0);
            } else {
                $_SESSION['alert'] = "Kata laluan berjaya dikemaskini";
                header("Location: home.php");
                exit(0);
            }
        }
    }
}

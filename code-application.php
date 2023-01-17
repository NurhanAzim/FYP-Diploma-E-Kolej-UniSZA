<?php
session_start();
include('includes/dbConn.php');
require_once __DIR__ . '/assets/composer/vendor/autoload.php';

if (isset($_POST['application_add-btn'])) {

    $randomBytes = random_bytes(4);
    $appId = unpack('N', $randomBytes)[1] & 0x7FFFFFFF;
    $appId = $appId % 1000000000;//generate 9 random number
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);
    $userId = (string) $_SESSION['auth_user']['userId'];

    $checkUser = "SELECT * FROM `tbl_application` WHERE `userId`='$userId' AND `statusId`=3";
    $checkUser_run = $conn->query($checkUser);
    if (mysqli_num_rows($checkUser_run) > 0) {
        $_SESSION['alert'] = "Anda sudah mempunyai permohonan yang berjaya";
        header("Location: application-view.php");
        exit(0);
    }

    $query = "INSERT INTO tbl_application (`appId`, `reason`, `userId`) VALUES ('$appId', '$reason', '$userId') LIMIT 1";
    $query_run = $conn->query($query);
    if ($query_run) {
        $_SESSION['alert'] = "Permohonan berjaya dihantar";
        header("Location: application-view.php");
        exit(0);
    } else {
        $_SESSION['alert'] = "Permohonan gagal dihantar";
        header("Location: application-add.php");
        exit(0);
    }
}

if (isset($_POST['application_edit-btn'])) {
    
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);

    $query = "UPDATE `tbl_application` SET `reason`='$reason' WHERE `appId`='".$_POST['appId']."'";
    $query_run = $conn->query($query);

    if ($query_run) {
        $_SESSION['alert'] = "Permohonan berjaya dikemaskini";
        header("Location: application-view.php");
        exit(0);
    } else {
        $_SESSION['alert'] = "Permohonan gagal dikemaskini";
        header("Location: application-view.php");
        exit(0);
    }
}

if (isset($_POST['delete_application-btn'])) {
    $appId = mysqli_real_escape_string($conn, $_POST['delete_application-btn']);
    $query = "DELETE FROM `tbl_application` WHERE `appId` ='$appId'";
    $query_run = $conn->query($query);

    if ($query_run) {
        $_SESSION['alert'] = "Permohonan berjaya dihapuskan";
        header("Location: application-view.php");
        exit(0);
    } else {
        $_SESSION['alert'] = "Permohonan gagal dihapuskan";
        header("Location: application-view.php");
        exit(0);
    }
}

<?php
include('../includes/dbConn.php');

if (isset($_POST['application_approve-btn'])) {
    $statusId = mysqli_real_escape_string($conn, $_POST['statusId']);
    $assignStatus = "UPDATE `tbl_application` SET `statusId`='$statusId' WHERE `appId`='" . $_POST['appId'] . "'";
    $assignStatus_run = $conn->query($assignStatus);
    
    if ($statusId == 4) {
        header("Location: application-list.php");
        exit(0);
    }

    $checkCapacity = "SELECT `roomId` FROM `tbl_room` WHERE `current_tenants` < `max_tenants` LIMIT 1"; //get first roomId
    $checkCapacity_run = $conn->query($checkCapacity);
    $result = mysqli_fetch_assoc($checkCapacity_run);
    $roomId = $result['roomId'];

    $assignRoom = "UPDATE `tbl_application` SET `roomId`='$roomId' WHERE `appId`='" . $_POST['appId'] . "'";
    $assignRoom_run = $conn->query($assignRoom);

    if ($assignRoom_run) {

        $updateCurrentTenant = "UPDATE `tbl_room` SET `current_tenants`=`current_tenants`+1 WHERE `roomId`='$roomId'";
        $updateCurrentTenant_run = $conn->query($updateCurrentTenant);

        if ($updateCurrentTenant_run) {
            $_SESSION['alert'] = "Status permohonan berjaya dikemaskini";
            header("Location: application-list.php");
            exit(0);
        } else {
            $_SESSION['alert'] = "Status permohonan gagal dikemaskini";
            header("Location: application-list.php");
            exit(0);
        }
    }
}

if (isset($_POST['submit_date-btn'])) {
    $startDate = mysqli_real_escape_string($conn, $_POST['startDate']);
    $endDate = mysqli_real_escape_string($conn, $_POST['endDate']);

    if ($startDate > $endDate) {
        $_SESSION['alert'] = "Tarikh mula tidak boleh melebihi tarikh tamat ";
        header("Location: dashboard.php");
        exit(0);
    } else if ($endDate < $startDate) {
        $_SESSION['alert'] = "Tarikh tamat tidak boleh awal daripada tarikh mula ";
        header("Location: dashboard.php");
        exit(0);
    }
    $query = "UPDATE `tbl_applicationdate` SET `startDate`='$startDate', `endDate`='$endDate' WHERE `id`=7";
    $query_run = $conn->query($query);

    if ($query_run) {
        $_SESSION['alert'] = "Tempoh permohonan berjaya dikemaskini";
        header("Location: dashboard.php");
        exit(0);
    } else {
        $_SESSION['alert'] = "Status permohonan gagal dikemaskini";
        header("Location: dashboard.php");
        exit(0);
    }
}

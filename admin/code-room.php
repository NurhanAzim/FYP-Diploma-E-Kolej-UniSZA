<?php
session_start();
include('../includes/dbConn.php');

if (isset($_POST['room_add-btn'])) {
    $block = mysqli_real_escape_string($conn, $_POST['block']);
    $floor = mysqli_real_escape_string($conn, $_POST['floor']);
    $roomNumber = mysqli_real_escape_string($conn, $_POST['roomNumber']);
    $max_tenants = mysqli_real_escape_string($conn, $_POST['max_tenants']);
    $current_tenants = mysqli_real_escape_string($conn, $_POST['current_tenants']);

    if ((filter_var($max_tenants, FILTER_VALIDATE_INT) === false) || (filter_var($current_tenants, FILTER_VALIDATE_INT) === false)) {
        $_SESSION['alert'] = "Sila masukkan nombor sahaja untuk kapasiti";
?>
        <script>
            window.history.back();
        </script>
    <?php
        exit(0);
    }

    if ($current_tenants > $max_tenants) {
        $_SESSION['alert'] = "Kapasiti semasa tidak boleh melebihi kapasiti maksimum";
    ?>
        <script>
            window.history.back();
        </script>
    <?php
        exit(0);
    }

    $checkSameRoom = "SELECT `block`,`floor`, `roomNumber` FROM `tbl_room` 
    WHERE `block`='$block' AND `floor`='$floor' AND `roomNumber`='$roomNumber'"; //check if room already exist
    $checkSameRoom_run = $conn->query($checkSameRoom);

    if ($checkSameRoom_run && mysqli_num_rows($checkSameRoom_run) > 0) {
        $_SESSION['alert'] = "Maklumat bilik sudah ada dalam sistem";
    ?>
        <script>
            window.history.back();
        </script>
    <?php
        exit(0);
    }
    $roomId = $block . $floor . $roomNumber;
    $query = "INSERT INTO tbl_room (roomId, `block`, `floor`, `roomNumber`, `max_tenants`, `current_tenants`) 
    VALUES ('$roomId', '$block', '$floor', '$roomNumber', '$max_tenants', '$current_tenants')";
    $query_run = $conn->query($query);

    if ($query_run) {
        $_SESSION['alert'] = "Data bilik berjaya dimasukkan";
        header("Location: room-add.php");
        exit(0);
    } else {
        $_SESSION['alert'] = "Data bilik gagal dimasukkan";
        header("Location: room-add.php");
        exit(0);
    }
}

if (isset($_POST['room_edit-btn'])) {
    $block = mysqli_real_escape_string($conn, $_POST['block']);
    $roomId = mysqli_real_escape_string($conn, $_POST['roomId']);
    $floor = mysqli_real_escape_string($conn, $_POST['floor']);
    $roomNumber = mysqli_real_escape_string($conn, $_POST['roomNumber']);
    $max_tenants = mysqli_real_escape_string($conn, $_POST['max_tenants']);
    $current_tenants = mysqli_real_escape_string($conn, $_POST['current_tenants']);

    if ((filter_var($max_tenants, FILTER_VALIDATE_INT) === false) || (filter_var($current_tenants, FILTER_VALIDATE_INT) === false)) {
        $_SESSION['alert'] = "Sila masukkan nombor sahaja untuk kapasiti";
    ?>
        <script>
            window.history.back();
        </script>
    <?php
        exit(0);
    }

    if ($current_tenants > $max_tenants) {
        $_SESSION['alert'] = "Kapasiti semasa tidak boleh melebihi kapasiti maksimum";
    ?>
        <script>
            window.history.back();
        </script>
    <?php
        exit(0);
    }

    $checkRoomTenant = "SELECT `roomId` FROM `tbl_application` WHERE `roomId`='$roomId'";
    $checkRoomTenant_run = $conn->query($checkRoomTenant);
    if ($max_tenants < mysqli_num_rows($checkRoomTenant_run)) {
        $_SESSION['alert'] = "Kapasiti maksimum tidak boleh lebih kecil daripada jumlah penghuni semasa";
    ?>
        <script>
            window.history.back();
        </script>
    <?php
        exit(0);
    } else if ($current_tenants < mysqli_num_rows($checkRoomTenant_run)) {
        $_SESSION['alert'] = "Kapasiti semasa tidak boleh lebih kecil daripada jumlah penghuni semasa";
    ?>
        <script>
            window.history.back();
        </script>
    <?php
        exit(0);
    }

    $checkSameRoom = "SELECT `block`,`roomNumber`,`floor` FROM `tbl_room` WHERE `block`='$block' AND `roomNumber`='$roomNumber' AND `floor`='$floor' AND `roomId`!='$roomId'";
    $checkSameRoom_run = $conn->query($checkSameRoom);
    if (mysqli_num_rows($checkSameRoom_run) > 0) {
        $_SESSION['alert'] = "Bilik dengan maklumat yang sama telah wujud";
    ?>
        <script>
            window.history.back();
        </script>
    <?php
        exit(0);
    }

    $query = "UPDATE `tbl_room` SET `block`='$block', `roomNumber`='$roomNumber', `floor`='$floor', `max_tenants`='$max_tenants', `current_tenants`='$current_tenants' WHERE `roomId`='$roomId'";
    $query_run = $conn->query($query);

    if ($query_run) {
        $_SESSION['alert'] = "Data bilik berjaya dikemaskini";
        header("Location: room-view.php");
        exit(0);
    } else {
        $_SESSION['alert'] = "Data bilik gagal dikemaskini";
        header("Location: room-view.php");
        exit(0);
    }
}

if (isset($_POST['delete_room-btn'])) {
    $getRoomId =  $_POST['delete_room_id'];

    if (empty($getRoomId)) {
        $_SESSION['alert'] = "Sila pilih bilik yang ingin dihapuskan";
        header("Location: room-view.php");
        exit(0);
    }

    $roomId = implode(',', $getRoomId);

    $checkTenant = "SELECT `roomId` FROM `tbl_application` WHERE `roomId` IN ('$roomId')";
    $checkTenant_run = $conn->query($checkTenant);
    if (mysqli_num_rows($checkTenant_run) > 0) {
        $_SESSION['alert'] = "Terdapat bilik yang masih mempunyai penghuni. Sila padamkan penghuni terlebih dahulu";
    ?>
        <script>
            window.history.back();
        </script>
    <?php
        exit(0);
    }

    $deleteRoom = "DELETE FROM `tbl_room` WHERE `roomId` IN ('$roomId')";
    $deleteRoom_run = $conn->query($deleteRoom);

    if ($deleteRoom_run) {
        $_SESSION['alert'] = "Data bilik berjaya dihapuskan";
        header("Location: room-view.php");
        exit(0);
    } else {
        $_SESSION['alert'] = "Data bilik gagal dihapuskan";
    ?>
        <script>
            window.history.back();
        </script>
<?php
        exit(0);
    }
}

<?php
session_start();
include('../includes/dbConn.php');

if (isset($_POST['login_admin-btn'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM `tbl_admin` WHERE `email`='$email' AND `password`='$password' LIMIT 1";
    $query_run = $conn->query($query);

    if (mysqli_num_rows($query_run) > 0) {

        foreach ($query_run as $data) {
            $adminId = $data['adminId'];
            $email = $data['email'];
        }
        $_SESSION['auth'] = true;
        $_SESSION['auth_admin'] = [
            'adminId' => $adminId,
            'email' => $email
        ];
        $_SESSION['alert'] = "Log masuk berjaya";
        header("Location: index.php");
        exit(0);
    } else {
        $_SESSION['alert'] = "Email atau kata laluan salah";
        ?>
        <script>
            window.history.back();
        </script>
    <?php
        exit(0);
    }
}
?>
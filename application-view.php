<?php
session_start();
if (($_SESSION['auth']) == false) {
    header("Location: student-login.php");
} else {
    include('includes/dbConn.php');
    include('includes/header.php');
    include('includes/navbar.php');

    if (isset($_SESSION['alert'])) {
        echo '<script>alert("' . $_SESSION['alert'] . '")</script>';
        unset($_SESSION['alert']);
    }
?>

    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Status Permohonan</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>ID Permohonan</td>
                                        <td>Tarikh Pohon</td>
                                        <td>Sebab Sokongan</td>
                                        <td>Status</td>
                                        <td>Kemaskini</td>
                                        <td>Hapus</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $userId = (string) $_SESSION['auth_user']['userId'];
                                    $checkTimeStamp = "SELECT * FROM `tbl_application` WHERE `userId`='$userId' AND `regdate` < DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY `regdate` DESC";
                                    $checkTimeStamp_run = $conn->query($checkTimeStamp);

                                    $query = "SELECT `tbl_application`.`appId`,`tbl_application`.`regdate`, `tbl_application`.`reason`, `tbl_application`.`statusId`, `tbl_applicationstatus`.`description`  
                                    FROM `tbl_application` INNER JOIN `tbl_applicationstatus` 
                                    ON `tbl_application`.`statusId` = `tbl_applicationstatus`.`statusId` 
                                    WHERE `userId` = '$userId' ORDER BY `regdate` ASC";

                                    $result = $conn->query($query);
                                    if (mysqli_num_rows($result) > 0) {
                                        $count = 0;
                                        foreach ($result as $row) {
                                    ?>
                                            <tr>
                                                <td><?= $row["appId"] ?></td>
                                                <td><?= $row["regdate"] ?></td>
                                                <td><?= $row["reason"] ?></td>
                                                <td><?= $row["description"] ?></td>
                                                <?php
                                                if ((mysqli_num_rows($checkTimeStamp_run) == 0) && ($row['statusId'] == 1)) {
                                                ?>
                                                    <td>
                                                        <a href="application-edit.php?appId=<?= $row['appId'] ?>" class="btn btn-success">Kemaskini</a>
                                                    </td>
                                                    <td>
                                                        <form action="code-application.php" method="POST">
                                                            <button type="submit" name="delete_application-btn" onclick="return confirm('Adakah anda pasti mahu menghapuskan permohonan?');" value="<?= $row['appId'] ?>" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="6">Tiada permohonan dibuat</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
    include('includes/footer.php');
}
    ?>
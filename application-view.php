<?php
session_start();
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
                                    <td>Sebab</td>
                                    <td>Status</td>
                                    <td>Kemaskini</td>
                                    <td>Hapus</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $currentTimestamp = date("Y-m-d H:i:s");
                                $getDbTimestamp = $conn->query("SELECT `regdate` FROM `tbl_application`");
                                $getResult = mysqli_fetch_assoc($getDbTimestamp);
                                if (isset($getResult['regdate'])) {
                                    $dbTimestamp = $getResult['regdate'];
                                    $diff = abs(strtotime($currentTimestamp) - strtotime($dbTimestamp));
                                    $days = floor($diff / (60 * 60 * 24)); //check if regdate more than one days
                                }

                                $userId = (string) $_SESSION['auth_user']['userId'];
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
                                            if (($days < 1) && ($row['statusId'] == 1)) {
                                            ?>
                                                <td>
                                                    <a href="application-edit.php?appId=<?= $row['appId'] ?>" class="btn btn-success">Kemaskini</a>
                                                </td>
                                                <td>
                                                    <form action="code-application.php" method="POST">
                                                        <button type="submit" name="delete_application-btn" value="<?= $row['appId'] ?>" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                        <?php
                                        if ($row['statusId'] == 3) {
                                            $count++;
                                        }
                                        if ($count == 0) {
                                        ?>
                            <tfoot>
                                <tr>
                                    <td colspan="6"><a href="application-add.php"><button class="btn btn-primary">Buat permohonan baru</button></a></td>
                                </tr>
                            </tfoot>
                        <?php
                                        }
                        ?>
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
    ?>
<?php
session_start();
if (($_SESSION['auth']) == false) {
    header("Location: login.php");
} else {
    include('../includes/dbConn.php');
    include('includes/header.php');

    if (isset($_SESSION['alert'])) {
        echo '<script>alert("' . $_SESSION['alert'] . '")</script>';
        unset($_SESSION['alert']);
    }
?>
    <div class="container-fluid px 4">
        <h1 class="mt-4">Permohonan Bilik</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item active">Permohonan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Rekod Permohonan
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <?php
                        if (isset($_GET['id'])) {
                            $appId = mysqli_real_escape_string($conn, $_GET['id']);
                            $query = "SELECT `tbl_application`.`appId`,`tbl_application`.`userId`, `tbl_application`.`reason`, `tbl_student`.`program`, `tbl_student`.`year` 
                            FROM `tbl_application` INNER JOIN tbl_student ON `tbl_application`.`userId` = `tbl_student`.`userId` WHERE `appId`='$appId' LIMIT 1";
                            $query_run = $conn->query($query);
                            $row = mysqli_fetch_assoc($query_run);

                            if ($row) {
                        ?>
                                <form action="code-application-admin.php" method="POST">
                                    <input type="hidden" id="appId" name="appId" value="<?= $row['appId'] ?>">
                                    <tr>
                                        <td>Id Pemohon</td>
                                        <td><?= $row['userId'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Program</td>
                                        <td><?= $row['program'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tahun Pengajian</td>
                                        <td><?= $row['year'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Sebab Permohonan</td>
                                        <td><?= $row['reason'] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Status Permohonan</td>
                                        <td><select id="statusId" name="statusId">
                                                <!--3=accept, 4=reject -->
                                                <option value="4" class="btn btn-danger">Tolak</option>
                                                <option value="3" class="btn btn-success">Terima</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><button name="application_approve-btn" onclick="return confirm('Sahkah status permohonan?')" class="btn btn-primary">Simpan Status Permohonan</button></td>
                                    </tr>
                                </form>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
    include('includes/footer.php');
    include('includes/scripts.php');
}
?>
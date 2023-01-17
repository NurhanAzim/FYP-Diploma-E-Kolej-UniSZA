<?php
session_start();
include('../includes/dbConn.php');
include('includes/header.php');

if (isset($_SESSION['alert'])) {
    echo '<script>alert("' . $_SESSION['alert'] . '")</script>';
    unset($_SESSION['alert']);
}
?>
<div class="container-fluid px 4">
    <h1 class="mt-4">Senarai Permohonan</h1>
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
                <thead>
                    <tr>
                        <td>Tarikh Pohon</td>
                        <td>Nama Pemohon</td>
                        <td>Program Pengajian</td>
                        <td>Tahun Pengajian</td>
                        <td>Kemaskini</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $currentTimestamp = date("Y-m-d H:i:s");
                    $getDbTimestamp = $conn->query("SELECT `regdate` FROM `tbl_application` WHERE `statusId`=1");
                    if (mysqli_num_rows($getDbTimestamp) > 0) {
                        $getResult = mysqli_fetch_assoc($getDbTimestamp);
                        $dbTimestamp = $getResult['regdate'];
                        $diff = abs(strtotime($currentTimestamp) - strtotime($dbTimestamp));
                        $days = floor($diff / (60 * 60 * 24)); //check if regdate more than one days

                        $query = "SELECT `tbl_application`.`appId`, `tbl_application`.`regdate`, `tbl_student`.`username`, `tbl_student`.`program`,`tbl_student`.`year` 
                        FROM `tbl_application` INNER JOIN `tbl_student` ON `tbl_application`.`userId`=`tbl_student`.`userId` 
                        WHERE `statusId`=1 AND '$days' >= 1 ORDER BY `regdate` DESC";
                        $query_run = $conn->query($query);
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                                <tr>
                                    <td><?= $row['regdate'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['program'] ?></td>
                                    <td><?= $row['year'] ?></td>
                                    <td>
                                        <a href="application-approve.php?id=<?= $row['appId'] ?>" class="btn btn-success">Kemaskini</a>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            echo $days;
                            ?>
                            <tr>
                                <td colspan="3">Tiada permohonan buat masa sekarang</td>
                            </tr>
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
?>
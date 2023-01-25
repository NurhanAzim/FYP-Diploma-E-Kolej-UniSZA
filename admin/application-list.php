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
        <h1 class="mt-4">Permohonan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Permohonan</li>
            <li class="breadcrumb-item active">Permohonan Baru</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Rekod Permohonan
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Tarikh Pohon</th>
                            <th>Nama Pemohon</th>
                            <th>Kod Program</th>
                            <th>Tahun Pengajian</th>
                            <th>Kemaskini</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query = "SELECT `tbl_application`.`appId`, `tbl_application`.`regdate`, `tbl_student`.`username`, `tbl_student`.`program`,`tbl_student`.`year` 
                            FROM `tbl_application` INNER JOIN `tbl_student` ON `tbl_application`.`userId`=`tbl_student`.`userId` 
                            WHERE `tbl_application`.`statusId`=1 AND `tbl_application`.`regdate` < DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY `regdate` DESC";

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
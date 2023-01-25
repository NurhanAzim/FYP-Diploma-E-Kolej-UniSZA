<?php
session_start();
if (($_SESSION['auth']) == false) {
    header("Location: login.php");
} else {
    include('../includes/dbConn.php');
    if (isset($_SESSION['alert'])) {
        echo '<script>alert("' . $_SESSION['alert'] . '")</script>';
        unset($_SESSION['alert']);
    }
    include('includes/header.php');
?>
    <div class="container-fluid px-4">
        <h4 class="mt-4">Pelajar</h4>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Pelajar</li>
            <li class="breadcrumb-item">Senarai Penghuni</li>
        </ol>
        <div class="card mb-4">
            <form action="code-application-admin.php" method="post">
                <div class="card-header">
                    <h4>Senarai Penghuni Kolej Kediaman
                    <button type="submit" name="delete_tenant-btn" onclick="return confirm('Adakah anda pasti mahu mengeluarkan penghuni tersebut daripada bilik?')" class="btn btn-danger float-end">Alih keluar</button>
                    </h4>
                </div>
                <div class="card-body">
                    <table id="myDataTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width:10px; text-align: center;">#</th>
                                <th>ID Bilik</th>
                                <th>Nama</th>
                                <th>E-mel</th>
                                <th>Program</th>
                                <th>Tahun Pengajian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT `tbl_application`.`userId`, `tbl_student`.`email`, `tbl_student`.`username`, `tbl_student`.`program`, `tbl_student`.`year`, `tbl_application`.`statusId`,`tbl_room`.`roomId` 
                            FROM `tbl_application` INNER JOIN `tbl_student` ON `tbl_application`.`userId` = `tbl_student`.`userId` INNER JOIN `tbl_room` ON `tbl_application`.`roomId`=`tbl_room`.`roomId` 
                            WHERE `tbl_application`.`statusId` = 3 ORDER BY `username` ASC";
                            $query_run = $conn->query($query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                            ?>
                                    <tr>
                                        <td><input type="checkbox" name="delete_tenant_id[<?= $row['roomId']?>]" value="<?= $row['userId'] ?>"></td>
                                        <td><?= $row['roomId'] ?></td>
                                        <td><?= $row['username'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['program'] ?></td>
                                        <td><?= $row['year'] ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
            </form>
        </div>
    </div>
    </div>
<?php
    include('includes/footer.php');
    include('includes/scripts.php');
}
?>
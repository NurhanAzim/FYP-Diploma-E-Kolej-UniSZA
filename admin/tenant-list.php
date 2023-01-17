<?php
session_start();
include('includes/header.php');
include('../includes/dbConn.php');
?>
<div class="container-fluid px-4">
    <h4 class="mt-4">Pelajar</h4>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item">Pelajar</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Senarai Penghuni Kolej Kediaman</h4>
                </div>
                <div class="card-body">
                    <table id="myDataTable" class="table table-bordered">
                        <thead>
                            <tr>
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
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>
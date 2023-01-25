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
    <div class="container-fluid px 4">
        <h1 class="mt-4">Permohonan</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Permohonan</li>
            <li class="breadcrumb-item active">Permohonan Yang Disahkan</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <h4>
                    <i class="fas fa-building me-1"></i>
                    Rekod Permohonan
                </h4>
            </div>
            <div class="card-body">
                <table id="myDataTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <td>Tarikh Pohon</td>
                            <td>Nama Pemohon</td>
                            <td>Status Permohonan</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $getAppList = "SELECT `tbl_application`.`regdate`, `tbl_applicationstatus`.`description`, `tbl_student`.`username`, `tbl_student`.`program`,`tbl_student`.`year` 
                            FROM `tbl_application` INNER JOIN `tbl_student` ON `tbl_application`.`userId`=`tbl_student`.`userId` INNER JOIN `tbl_applicationstatus` ON `tbl_application`.`statusId`=`tbl_applicationstatus`.`statusId`
                            WHERE `tbl_application`.`statusId`!=1  ORDER BY `regdate` DESC";
                        $result = $conn->query($getAppList);
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <tr>
                                <td><?= $row['regdate'] ?></td>
                                <td><?= $row['username'] ?></td>
                                <td><?= $row['description'] ?></td>
                            </tr>
                        <?php
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
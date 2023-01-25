<?php
session_start();
if (($_SESSION['auth']) == false) {
    header("Location: login.php");
} else {
    include('includes/header.php');
    include('../includes/dbConn.php');

    if (isset($_SESSION['alert'])) {
        echo '<script>alert("' . $_SESSION['alert'] . '")</script>';
        unset($_SESSION['alert']);
    }
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Panel Admin</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-9 col-md-6 justify-content-center">
                <div class="card-body">
                    <div class="card bg-danger test-white mb-4">
                        <h4 class="card-header text-center " style="color: white;">Tempoh Permohonan</h4>
                        <div class="card-body">
                            <form action="code-application-admin.php" method="POST">
                                <?php
                                $getDate = "SELECT * FROM `tbl_applicationdate` WHERE `id`=7 LIMIT 1";
                                $getDate_run = $conn->query($getDate);
                                $result = mysqli_fetch_assoc($getDate_run);
                                if ($result) {
                                ?>
                                    <div class="col-md-4 mb-3">
                                        <label style="color: white;" for="startDate">Tarikh Mula:</label>
                                        <input type="date" id="startDate" name="startDate" value="<?= $result['startDate'] ?>" class="form-control">
                                        <label style="color: white;" for="endDate">Tarikh Tutup:</label>
                                        <input type="date" id="endDate" name="endDate" value="<?= $result['endDate'] ?>" class="form-control">
                                    </div>
                                <?php } ?>
                                <div class="col-md-10 mb-3">
                                    <button type="submit" name="submit_date-btn" onclick="return confirm('Adakah anda pasti mahu menyimpan tarikh untuk tempoh permohonan tersebut?')" class="btn btn-light">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card-body">
                    <div class="card bg-warning test-white mb-4">
                        <div class="card-body">Jumlah Permohonan Baru
                            <?php

                            $query = "SELECT * FROM `tbl_application` WHERE `tbl_application`.`statusId`=1 AND 
                            `tbl_application`.`regdate` < DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY `regdate` DESC";
                            $query_run = $conn->query($query);
                            if ($total = mysqli_num_rows($query_run)) {
                                echo '<h4 class="mb-0">' . $total . '</h4>';
                            } else {
                                echo '<h4 class="mb-0">Tiada Data</h4>';
                            }
                            ?>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card-body">
                    <div class="card bg-warning test-white mb-4">
                        <div class="card-body">Jumlah Bilik
                            <?php
                            $getRoomList = "SELECT * FROM tbl_room ORDER BY `floor` ASC , `roomNumber` ASC";
                            $roomList = $conn->query($getRoomList);
                            if ($total = mysqli_num_rows($roomList)) {
                                echo '<h4 class="mb-0">' . $total . '</h4>';
                            } else {
                                echo '<h4 class="mb-0">Tiada Data</h4>';
                            }

                            ?>
                            <h4 class="mb-0"></h4>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card-body">
                    <div class="card bg-warning test-white mb-4">
                        <div class="card-body">Jumlah Penghuni Semasa
                            <?php
                            $getTenantList = "SELECT * FROM `tbl_application` WHERE `tbl_application`.`statusId` = 3 ";
                            $TenantList = $conn->query($getTenantList);
                            if ($total = mysqli_num_rows($TenantList)) {
                                echo '<h4 class="mb-0">' . $total . '</h4>';
                            } else {
                                echo '<h4 class="mb-0">Tiada Data</h4>';
                            }
                            ?>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card-body">
                    <div class="card bg-warning test-white mb-4">
                        <div class="card-body">Kekosongan Penghuni
                            <?php
                            $getRemainingCapacity = "SELECT SUM(max_tenants - current_tenants) as remaining_capacity FROM tbl_room";
                            $result = $conn->query($getRemainingCapacity);
                            $remainingCapacity = mysqli_fetch_assoc($result);
                            if ($result) {
                                echo '<h4 class="mb-0">' . $remainingCapacity['remaining_capacity'] . '</h4>';
                            } else {
                                echo '<h4 class="mb-0">Tiada Data</h4>';
                            }

                            ?>
                            <h4 class="mb-0"></h4>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include('includes/footer.php');
    include('includes/scripts.php');
}
?>
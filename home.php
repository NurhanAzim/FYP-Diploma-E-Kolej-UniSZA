<?php
session_start();
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Maklumat Profil Pelajar</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION['auth_user'])) {
                            $userId = (string) $_SESSION['auth_user']['userId'];
                            $query = "SELECT * FROM `tbl_student` WHERE `userId` = '$userId'";
                            $query_run = $conn->query($query);
                            $result = mysqli_fetch_assoc($query_run);

                            if ($result) {
                        ?>
                                <form name="form" action="code-student.php" method="POST" onsubmit="validateForm()">
                                    <div class="col-md-12 mb-3">
                                        <label>Nama Penuh</label><br>
                                        <input type="text" name="username" placeholder="" value="<?= $result['username'] ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Program Pengajian</label><br>
                                        <select id="program" name="program" class="form-control" required>
                                            <option value="<?= $result['program'] ?>"><?= $result['program'] ?></option>
                                            <option value="FIK">FIK</option>
                                            <option value="FBIM">FBIM</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Tahun Pengajian</label><br>
                                        <input type="text" name="year" placeholder="" value="<?= $result['year'] ?>" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" name="profile_edit-btn" class="btn btn-primary">Kemaskini</button>
                                    </div>
                                </form>
                        <?php
                            }
                        } else {
                            echo "<h4>Ralat</h4>";
                        }

                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Maklumat Bilik Pelajar</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_SESSION['auth_user'])) {
                            $userId = (string) $_SESSION['auth_user']['userId'];
                            $query = "SELECT * FROM `tbl_application` WHERE `userId`='$userId'"; //check if student already have room
                            $query_run = $conn->query($query);
                            $resultApp = mysqli_fetch_assoc($query_run);


                            if (isset($resultApp['roomId'])) {
                                $roomId = $resultApp['roomId'];
                                $getRoom = "SELECT `block`, `floor`, `roomNumber` FROM `tbl_room` WHERE `roomId`='$roomId'";
                                $getRoom_run = $conn->query($getRoom);
                                $result = mysqli_fetch_assoc($getRoom_run);
                        ?>
                                <div class="col-md-6 mb-3">
                                    <label for="floor">Aras</label>
                                    <input type="text" name="floor" value="<?= $result['floor'] ?>" class="form-control" disabled>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="roomNumber">Nombor Bilik</label>
                                    <input type="text" id="roomNumber" name="roomNumber" value="<?= $result['roomNumber'] ?>" class="form-control" disabled>
                                </div>
                            <?php
                            } else if (isset($resultApp['appId'])) { ?>
                                Pelajar telah membuat permohonan bilik kolej kediaman<br><br>
                                <div class="col-md-12 mb-3">
                                    <a href="application-view.php"><button class="btn btn-primary">Semak permohonan di sini</button></a>
                                </div>
                            <?php
                            } else { ?>
                                Pelajar belum mempunyai bilik kolej kediaman<br><br>
                                <div class="col-md-12 mb-3">
                                    <a href="application-add.php"><button class="btn btn-primary">Buat permohonan bilik</button></a>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>
<?php
session_start();
if (($_SESSION['auth']) == false) {
    header("Location: student-login.php");
} else {
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
                            <h4>Maklumat Profil</h4>
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
                                            <label>Kod Program</label><br>
                                            <select id="program" name="program" class="form-control" required>
                                                <option value="<?= $result['program'] ?>"><?= $result['program'] ?></option>
                                                <option value="DSK">DSK</option>
                                                <option value="DTM">DTM</option>
                                                <option value="KRK">KRK</option>
                                                <option value="KI">KI</option>
                                                <option value="PP">PP</option>
                                                <option value="IM">IM</option>
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
                            <h4>Maklumat Bilik</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['auth_user'])) {
                                $userId = (string) $_SESSION['auth_user']['userId'];
                                $query = "SELECT * FROM `tbl_application` WHERE `userId`='$userId'"; //check if student already have room
                                $query_run = $conn->query($query);
                                $resultApp = mysqli_fetch_assoc($query_run);

                                $checkAppDate = "SELECT `startDate`, `endDate` FROM `tbl_applicationdate` WHERE CURDATE() BETWEEN `startDate` AND `endDate`"; //check  if still within application date
                                $AppDate = $conn->query($checkAppDate);
                                if (mysqli_num_rows($AppDate) == 0) {
                                    echo "Tempoh Permohonan Kolej Kediaman sudah tamat";
                                    
                                } else if (isset($resultApp['roomId'])) {
                                    $roomId = $resultApp['roomId'];
                                    $getRoomInfo = "SELECT `block`, `floor`, `roomNumber` FROM `tbl_room` WHERE `roomId`='$roomId'";
                                    $roomInfo = $conn->query($getRoomInfo);
                                    $result = mysqli_fetch_assoc($roomInfo);
                            ?>
                                    <div class="col-md-6 mb-3">
                                        <label for="block">Blok</label>
                                        <input type="text" name="block" value="<?= $result['block'] ?>" class="form-control" disabled>
                                    </div>
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
}
?>
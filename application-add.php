<?php
session_start();
if (($_SESSION['auth']) == false) {
    header("Location: student-login.php");
} else {
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
                <div class="col-md-5">
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
                                    <div class="col-md-12 mb-3">
                                        <label>Nama Penuh</label><br>
                                        <input type="text" name="username" placeholder="" value="<?= $result['username'] ?>" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Kod Program</label><br>
                                        <select id="program" name="program" class="form-control" disabled>
                                            <option value="<?= $result['program'] ?>"><?= $result['program'] ?></option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Tahun Pengajian</label><br>
                                        <input type="text" name="year" placeholder="" value="<?= $result['year'] ?>" class="form-control" disabled>
                                    </div>
                                    <form name="form" action="code-application.php" method="POST">
                                        <div class="col-md-12 mb-3">
                                            <label for="reason">Sebab Sokongan</label>
                                            <textarea id="reason" name="reason" class="form-control" cols="50" rows="7"></textarea>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <button type="submit" name="application_add-btn" class="btn btn-primary">Hantar</button>
                                        </div>
                                    </form>
                            <?php
                                }
                            } else {
                                echo "<h4>Ralat</h4>";
                            }
                            ?>

                        </div>
                        </form>
                    </div>
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
<?php
include('includes/dbConn.php');
$getAppDate = "SELECT `startDate`, `endDate` FROM `tbl_applicationdate` WHERE CURDATE() BETWEEN `startDate` AND `endDate`";
$getAppDate_run = $conn->query($getAppDate);
if (mysqli_num_rows($getAppDate_run) > 0) {
    
    if(isset($_SESSION['alert'])) {
        echo '<script>alert("'.$_SESSION['alert'].'")</script>';
        unset($_SESSION['alert']);
     }

    include('includes/header.php');
    include('includes/navbar.php');
?>
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Log Masuk Pelajar</h4>
                        </div>
                        <div class="card-body ">
                            <form action="code-student.php" id="profile-form" method="POST">
                                <div class="col-md-12 mb-3">
                                    <label>Email Putra</label>
                                    <input type="email" name="email" id="email" patern="/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@putra\.unisza\.edu\.my$/" class="form-control" required autofocus>
                                    <div class="invalid-feedback">
                                        Sila masukkan e-mel.
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Kata Laluan</label>
                                    <input type="password" name="password" id="password" class="form-control" required>
                                    <div class="invalid-feedback">
                                        Sila masukkan kata laluan.
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button class="btn btn-primary" name="login_student-btn">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
    include('includes/footer.php');
} else {
    header("Location: application-closed.php");
}

?>
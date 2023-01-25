<?php include('includes/dbConn.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Kolej UniSZA</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap5.min.css">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">E-Kolej UniSZA</a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    </div>
  </div>
</nav>
    <div class="details-wrapper" style="padding: 0px 0 0px 0;">
        <div class="container">
            <div class="row ">
                <div class="col-md-8 mx-auto py-5 text-center">
                    <h1>Menu Log Masuk</h1>
                    <h4 class="font-weight-light"> Sila pilih kategori pengguna </h4>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-5 pb-3">
                    <div class="card" style="">
                    <img class="card-image-top" src="assets/images/staff.png" alt="image" style="border-radius: 10px; height: 90px; width: 90px; position: absolute; vertical-align: middle; ">
                        <a href="admin/login.php">
                            <div class="card-body text-center">
                                
                                <h4 id="result" class="card-title">Staf</h4>
                                <p class="card-text"> Staf Kolej Kediaman Taman Ilmu sahaja </p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-5 pb-3">
                    <div class="card" style="">
                    <img src="assets/images/student.png" alt="image" class="card-image-top" style="border-radius: 10px; height: 90px; width: 90px; position: absolute; vertical-align: middle;">
                        <a href="student-login.php" class="card-link">
                            <div class="card-body text-center">
                                
                                <h4 class="card-title">Mahasiswa</h4>
                                <p class="card-text"> Mahasiswa UniSZA kampus Besut lelaki sahaja </p>
                            </div>
                        </a>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="layoutError_footer">
        <footer class="py-4 bg-light fixed-bottom" style="position:absolute; bottom:0; width:100%;">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; E-Kolej UniSZA 2022</div>
                </div>
            </div>
        </footer>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <!--<script src="assets/js/custom.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/bootstrap5.bundle.min.js"></script>

</body>

</html>
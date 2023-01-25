<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Sistem Permohonan Kolej Kediaman</title>
    <link href="css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.php">E-Kolej UniSZA</a>
        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="../index.php">Kembali ke menu log masuk</a>
            </li>
        </ul>
    </nav>

    <div id="layoutSidenav">
        <div id="layoutSidenav_content">
            <main>
                <div class="py-5">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Log Masuk Admin</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="code-admin.php" method="POST">
                                            <div class="col-md-12 mb-4">
                                                <span class="far fa-user"></span>
                                                <label>E-mel</label>
                                                <input type="text" name="email" id="email" value="admin@gmail.com" placeholder="E-mel" class="form-control">
                                            </div>
                                            <div class="col-md-12 mb-4">
                                                <span class="fas fa-key"></span>
                                                <label>Kata Laluan</label>
                                                <input type="password" name="password" id="password" value="11111111" placeholder="Kata laluan" class="form-control">
                                            </div class="col-md-12 mb-4">
                                            <a href="index.php"><button type="submit" name="login_admin-btn" class="btn btn-primary">Log Masuk</button></a>
                                        </form>
                                    </div>
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
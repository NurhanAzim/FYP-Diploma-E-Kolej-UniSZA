<?php
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
                        <h4>Daftar Akaun Pelajar</h4>
                    </div>
                    <div class="card-body">
                        <form action="code-student.php" method="POST">
                            <div class="col-md-12 mb-3">
                                <label>Nama Penuh</label><br>
                                <input type="text" name="username" id="username" class="form-control" required autocomplete="name">
                                <div class="invalid-feedback">
                                    sila masukkan nama penuh
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>E-mel Putra</label><br>
                                <input type="email" name="email" id="email" class="form-control" required autocomplete="email">
                                <div class="invalid-feedback">
                                    sila masukkan email
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Kata Laluan</label><br>
                                <input type="password" name="password" class="form-control" required>
                                <div class="invalid-feedback">
                                    sila masukkan kata laluan
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Sahkan Kata Laluan</label><br>
                                <input type="password" name="cpassword" class="form-control" required>
                                <div class="invalid-feedback">
                                    sila masukkan kata laluan sekali lagi
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Program Pengajian</label><br>
                                <select id="program" name="program" data-placeholder="Pilih Program" class="form-control" required>
                                    <option value="">Pilih Program</option>
                                    <option value="FIK">FIK</option>
                                    <option value="FBIM">FBIM</option>
                                </select>
                                <div class="invalid-feedback">
                                    sila pilih satu program
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Tahun Pengajian</label><br>
                                <input type="text" name="year" placeholder="" pattern="[0-9]*" max="8" class="form-control" required>
                                <div class="invalid-feedback">
                                    sila masukkan tahun pengajian
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" name="register_student-btn" class="btn btn-primary">Daftar</button>
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
?>
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
                <div class="col-md-8">
                    <div class="card">
                        <h4 class="card-header">Terma & Syarat</h4>
                        <div class="card-body">
                            <!--<h6>Terma</h6>-->
                            <p>1. Mahasiswa dibenarkan membuat permohonan sekali sahaja</p>
                            <p>2. Permohonan boleh dikemaskini atau dihapuskan dalam tempoh 24 jam permohonan dibuat sahaja</p>
                            <p>3. Permohonan akan diluluskan paling awal sehari selepas permohonan dibuat atau bergantung kepada pihak pengurusan kolej kediaman</p>
                            <p>4. Sistem masih boleh diakses 7 hari selepas tarikh akhir permohonan dibuka jika pemohon ingin menyemak keputusan permohonan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
    include('includes/footer.php');
}
    ?>
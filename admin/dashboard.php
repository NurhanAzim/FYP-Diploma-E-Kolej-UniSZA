<?php
session_start();
include('includes/header.php');

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
        <div class="col-xl-3 col-md-6">
            <div class="card-body">
                <form action="code-application-admin.php" method="POST">
                    <div class="col-md-6 mb-3">
                        <label for="">Tarikh Mula</label>
                        <input type="date" id="startDate" name="startDate" value="<? $_SESSION['startDate']?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Tarikh Tutup</label>
                        <input type="date" id="endDate" name="endDate" value="<? $_SESSION['endDate']?>" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <button type="submit" name="submit_date-btn">Simpan</button>
                    </div>
                    <? if(isset($_SESSION['startDate']) && isset($_SESSION['endDate'])) {
                        echo $_SESSION['startDate'];
                        echo $_SESSION['endDate'];
                    } 
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>
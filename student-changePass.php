<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Tukar Kata Laluan</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-4">
                            <label for="oldPass">Kata Laluan Semasa</label>
                            <input type="password" name="oldPass" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="oldPass">Kata Laluan Baru</label>
                            <input type="password" name="newPass" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="oldPass">Sahkan Kata Laluan</label>
                            <input type="password" name="confirmPass" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="oldPass">Kata Laluan Semasa</label>
                            <input type="password" name="change_pass-btn" class="form-control btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
?>
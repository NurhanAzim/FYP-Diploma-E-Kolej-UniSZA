<?php
include('includes/header.php');
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Admin</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Admin</li>
    </ol>
    <div class="card-header">
        <h4>Log Masuk Admin</h4>
    </div>
    <div class="card-body">
        <div class="col-md-6 mb-3">
            <span class="far fa-user"></span>
            <label>E-mel</label>
            <input type="text" name="email" id="email" value="admin@gmail.com" placeholder="E-mel" class="form-control">
        </div>
        <div class="col-md-6 mb-3">
            <span class="fas fa-key"></span>
            <label>Kata Laluan</label>
            <input type="password" name="password" id="password" value="password" placeholder="Kata laluan" class="form-control">
        </div class="col-md-12 mb-3">
        <a href="dashboard.php"><button type="submit" name="login_admin-btn" class="btn btn-primary">Log Masuk</button></a>
    </div>
</div>
</div>
</div>
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>
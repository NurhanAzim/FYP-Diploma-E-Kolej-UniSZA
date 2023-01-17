<?php
session_start();
include('includes/header.php');

if (isset($_SESSION['alert'])) {
    echo '<script>alert("' . $_SESSION['alert'] . '")</script>';
    unset($_SESSION['alert']);
}
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Bilik</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Masukkan maklumat bilik</li>
    </ol>
    <div class="card-body">
        <form action="code-room.php" method="POST">
            <div class="col-md-6 mb-3">
                <label for="block">Blok</label>
                <input type="text" id="block" name="block" max="3" patern="^[a-zA-Z]+$" class="form-control" required>
                <div class="invalid-feedback">
                    Sila masukkan blok
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="floor">Aras</label>
                <select id="floor" name="floor" data-placeholder="Sila pilih aras" class="form-control" required>
                    <option value="">Sila pilih aras</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select>
                <div class="invalid-feedback">
                    Sila pilih aras
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="roomNumber">Nombor Bilik</label>
                <input type="text" id="roomNumber" name="roomNumber" class="form-control" required>
                <div class="invalid-feedback">
                    Sila masukkan nombor bilik
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="capacity">Kapasiti Maksimum</label>
                <input type="text" id="max_tenants" name="max_tenants" value="1" min="1" pattern="[0-9]*" class="form-control" required>
                <div class="invalid-feedback">
                    Sila masukkan kapasiti maksimum
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label for="capacity">Kapasiti Semasa</label>
                <input type="text" id="current_tenants" name="current_tenants" value="0" min="0" pattern="[0-9]*" class="form-control" required>
                <div class="invalid-feedback">
                    Sila masukkan kapasiti semasa
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <button type="submit" name="room_add-btn" class="btn btn-primary">Hantar</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<?php
include('includes/footer.php');
?>
<script>
    let max_tenants = document.getElementById("max_tenants");
    let current_tenants = document.getElementById("current_tenants");

    current_tenants.setAttribute("max", max_tenants.value);
</script>
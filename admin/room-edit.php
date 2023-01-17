<?php
include('../includes/dbConn.php');
session_start();

if (isset($_SESSION['alert'])) {
    echo '<script>alert("' . $_SESSION['alert'] . '")</script>';
    unset($_SESSION['alert']);
}
include('includes/header.php');
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Kemaskini Bilik</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Kemaskini maklumat bilik</li>
    </ol>
    <div class="card-body">
        <?php
        if (isset($_GET['id'])) {
            $roomId = mysqli_real_escape_string($conn, $_GET['id']);
            $query = "SELECT * FROM tbl_room WHERE roomId='$roomId' LIMIT 1";
            $query_run = $conn->query($query);
            $result = mysqli_fetch_assoc($query_run);
            if ($result) {
        ?>
                <form action="code-room.php" method="POST">
                    <input type="hidden" id="roomId" name="roomId" value="<?= $result['roomId'] ?>" class="form-control">
                    <div class="col-md-6 mb-3">
                        <label for="block">Blok</label>
                        <input type="text" id="block" name="block" max="3" patern="^[a-zA-Z]+$" value="<?= $result['block']?>" class="form-control" required>
                        <div class="invalid-feedback">
                            Sila masukkan blok
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="floor">Aras</label>
                        <select id="floor" name="floor" class="form-control" required>
                            <option value="<? $result['floor']?>"><?= $result['floor']?></option>
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
                        <input type="text" id="roomNumber" name="roomNumber" value="<?= $result['roomNumber']?>" class="form-control" required>
                        <div class="invalid-feedback">
                            Sila masukkan nombor bilik
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="capacity">Kapasiti Maksimum</label>
                        <input type="text" id="max_tenants" name="max_tenants" value="<?= $result['max_tenants']?>" min="1" pattern="[0-9]*" class="form-control" required>
                        <div class="invalid-feedback">
                            Sila masukkan kapasiti maksimum
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="capacity">Kapasiti Semasa</label>
                        <input type="text" id="current_tenants" name="current_tenants" value="<?= $result['current_tenants']?>" min="0" pattern="[0-9]*" class="form-control" required>
                        <div class="invalid-feedback">
                            Sila masukkan kapasiti semasa
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" name="room_edit-btn" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
        <?php
            } else {
                echo "<h4>Tiada rekod bilik ditemui</h4>";
            }
        } else {
            echo "<h4>Ralat</h4>";
        }
        ?>
    </div>
</div>
</div>
</div>
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>
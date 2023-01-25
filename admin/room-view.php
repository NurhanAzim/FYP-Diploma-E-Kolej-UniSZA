<?php
session_start();
if (($_SESSION['auth']) == false) {
    header("Location: login.php");
} else {
    include('../includes/dbConn.php');

    if (isset($_SESSION['alert'])) {
        echo '<script>alert("' . $_SESSION['alert'] . '")</script>';
        unset($_SESSION['alert']);
    }

    include('includes/header.php');
?>
    <div class="container-fluid px 4">
        <h1 class="mt-4">Bilik</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Senarai Bilik</li>
        </ol>
        <div class="card mb-4">
            <form action="code-room.php" method="POST">
                <div class="card-header">
                    <h4>
                        <i class="fas fa-building me-1"></i>
                        Rekod Bilik
                        <a href="room-add.php" class="btn btn-primary float-end">Tambah Bilik</a>
                        <button type="submit" name="delete_room-btn" onclick="return confirm('Adakah anda pasti mahu menghapuskan rekod bilik tersebut?')" class="btn btn-danger float-end">Hapus</button>
                    </h4>
                </div>
                <div class="card-body">
                    <table id="myDataTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td style="width:10px; text-align: center;">#</td>
                                <td>Blok</td>
                                <td>Aras</td>
                                <td>Nombor Bilik</td>
                                <td>Kapasiti Maksimum</td>
                                <td>Kapasiti Semasa</td>
                                <td style="width:40px; text-align: center;">Kemaskini</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $roomQuery = "SELECT * FROM tbl_room ORDER BY `floor` ASC , `roomNumber` ASC";
                            $result = $conn->query($roomQuery);
                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                                <tr>
                                    <td><input type="checkbox" name="delete_room_id[]" value="<?= $row['roomId'] ?>"></td>
                                    <td><?= $row['block'] ?></td>
                                    <td><?= $row['floor'] ?></td>
                                    <td><?= $row['roomNumber'] ?></td>
                                    <td><?= $row['max_tenants'] ?></td>
                                    <td><?= $row['current_tenants'] ?></td>
                                    <td>
                                        <a href="room-edit.php?id=<?= $row['roomId']; ?>" class="btn btn-success">Kemaskini</a>
                                </tr>
                            <?php
                            }

                            ?>
            </form>
            </tbody>
            </table>
        </div>
    </div>
<?php include('includes/footer.php'); ?>
<?php include('includes/scripts.php');
}
?>
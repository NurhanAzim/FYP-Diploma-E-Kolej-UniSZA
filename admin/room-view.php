<?php
session_start();
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
        <li class="breadcrumb-item active">Senarai Bilik</li>
    </ol>
    <div class="card mb-4">
        <div class="card-header">
            <h4>
                <i class="fas fa-table me-1"></i>
                Rekod Bilik
                <a href="room-add.php" class="btn btn-primary float-end">Tambah Bilik</a>
            </h4>
        </div>
        <div class="card-body">
            <table id="myDataTable" class="table table-bordered">
                <thead>
                    <tr>
                        <td>Blok</td>
                        <td>Aras</td>
                        <td>Nombor Bilik</td>
                        <td>Kemaskini</td>
                        <td>Hapus</td>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $roomQuery = "SELECT * FROM tbl_room ORDER BY `floor` ASC , `roomNumber` ASC";
                    $result = $conn->query($roomQuery);
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?= $row['block'] ?></td>
                            <td><?= $row['floor'] ?></td>
                            <td><?= $row['roomNumber'] ?></td>
                            <td>
                                <a href="room-edit.php?id=<?= $row['roomId']; ?>" class="btn btn-success">Kemaskini</a>
                            <td>
                                <form action="code-room.php" method="POST">
                                    <button type="submit" name="delete_room-btn" value="<?= $row['roomId'] ?>" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>
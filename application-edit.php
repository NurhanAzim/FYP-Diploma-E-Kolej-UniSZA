<?php
session_start();
include('includes/dbConn.php');
include('includes/header.php');
include('includes/navbar.php');
?>

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Kemaskini Permohonan</h4>
                    </div>
                    <div class="card-body">
                    <?php
                    if (isset($_GET['appId'])) {
                        $query = "SELECT `appId`,`reason` FROM `tbl_application` WHERE `appId`='".$_GET['appId']."'";
                        $query_run = $conn->query($query);
                        $result = mysqli_fetch_assoc($query_run);

                        if ($result) {
                    ?>
                            <form action="code-application.php" method="POST">
                                <input type="hidden" name="appId" value="<?= $result['appId'] ?>">
                                <div class="form-group">
                                    <label for="reason">Sebab Permohonan</label>
                                    <textarea id="reason" name="reason" class="form-control"><?= $result['reason'] ?></textarea>
                                </div>
                                <div>
                                    <button type="submit" name="application_edit-btn" class="btn btn-primary">Kemaskini Permohonan</button>
                                </div>
                            </form>
                    <?php
                        } else {
                            echo "<h4>Tiada Rekod Permohonan Ditemui</h4>";
                        }
                    } else {
                        echo "<h4>Ralat</h4>";
                    }

                    ?>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>

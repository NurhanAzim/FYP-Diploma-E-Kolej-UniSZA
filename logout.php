<?php
session_start();
$tmp1 = $_SESSION['startDate'];
$tmp2 = $_SESSION['endDate'];
session_unset();
$_SESSION['startDate'] = $tmp1;
$_SESSION['endDate'] = $tmp2;
header("Location: index.php");
exit;
?>
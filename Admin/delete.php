<?php
include './config/config.php';
$sql = "DELETE FROM tblnetworkkanteen WHERE id = $_GET[id]";
$database->query($sql);
header('location: ./index.php');
?>

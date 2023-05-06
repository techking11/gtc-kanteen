<?php
include './config/config.php';
$sql = "DELETE FROM tblteamdata WHERE id = $_GET[id]";
$database->query($sql);
header('location: ./team.php');
?>
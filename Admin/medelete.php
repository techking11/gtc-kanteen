<?php
include './config/config.php';
$sql = "DELETE FROM tblmekanteen WHERE id = $_GET[id]";
$database->query($sql);
header('location: ./mekanteen.php');
?>

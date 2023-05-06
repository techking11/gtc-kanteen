<?php
include './config/config.php';
$sql = "DELETE FROM tblareekanteen WHERE id = $_GET[id]";
$database->query($sql);
header('location: ./areekanteen.php');
?>

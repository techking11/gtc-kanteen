<?php
include './config/config.php';
$sql = "DELETE FROM tbldrawingkanteen WHERE id = $_GET[id]";
$database->query($sql);
header('location: ./drawingkanteen.php');
?>

<?php
include './config/config.php';
$sql = "DELETE FROM tblbubblekanteen WHERE id = $_GET[id]";
$database->query($sql);
header('location: ./bubblekanteen.php');
?>

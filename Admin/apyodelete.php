<?php
include './config/config.php';
$sql = "DELETE FROM tblapyokanteen WHERE id = $_GET[id]";
$database->query($sql);
header('location: ./apyokanteen.php');
?>

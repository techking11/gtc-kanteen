<?php
session_start();
include './config/config.php';
if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
  echo "<script>window.location.href='login.php'</script>";
}
$stmt = $database->prepare("SELECT * FROM tbltemporder WHERE id=".$_GET['id']);
$stmt->execute();
$result = $stmt->fetchAll();

$menuname = $result[0]['menu_name'];
$kanteen = $result[0]['kanteen'];
$orderno = $result[0]['order_no'];
$ordersend = 1;
$orderuser = $result[0]['order_user'];
$phoneno = $result[0]['phone_no'];
$address = $result[0]['address'];
$orderdate = $result[0]['order_date'];
$ordertime = $result[0]['order_time'];

$sql = "INSERT INTO tblorder (menu_name, kanteen, order_no, order_send, order_user, phone_no, address, order_date, order_time) VALUES (?, ?, ?, ?,?,?,?,?,?)";

if ($stmt = $database->prepare($sql)) {
  $stmt->bindParam(1, $menuname);
  $stmt->bindParam(2, $kanteen);
  $stmt->bindParam(3, $orderno);
  $stmt->bindParam(4, $ordersend);
  $stmt->bindParam(5, $orderuser);
  $stmt->bindParam(6, $phoneno);
  $stmt->bindParam(7, $address);
  $stmt->bindParam(8, $orderdate);
  $stmt->bindParam(9, $ordertime);
}
$stmt->execute();
$sql = "DELETE FROM tbltemporder WHERE id =".$_GET['id'];
$database->query($sql);
echo "<script>window.location.href='temporder.php'</script>";

?>

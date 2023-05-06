<?php
session_start();
include './config/config.php';
if(empty($_SESSION['user_id']) && empty($_SESSION['logged_in'])) {
  echo "<script>window.location.href='login.php'</script>";
}
$stmt = $database->prepare("SELECT * FROM tbltempcontact WHERE id=".$_GET['id']);
$stmt->execute();
$result = $stmt->fetchAll();

$email = $result[0]['email'];
$comment = $result[0]['comment'];
$date = $result[0]['contact_date'];
$time = $result[0]['contact_time'];

$sql = "INSERT INTO tblcontact (email, comment, contact_date, contact_time) VALUES (?, ?, ?, ?)";

if ($stmt = $database->prepare($sql)) {
  $stmt->bindParam(1, $email);
  $stmt->bindParam(2, $comment);
  $stmt->bindParam(3, $date);
  $stmt->bindParam(4, $time);
}
$stmt->execute();
$sql = "DELETE FROM tbltempcontact WHERE id =".$_GET['id'];
$database->query($sql);
echo "<script>window.location.href='tempcontact.php'</script>";

?>

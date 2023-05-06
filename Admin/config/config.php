<?php
try {
  $database = new PDO('mysql:host=localhost;dbname='. 'dbgtckanteen', 'root', '');
} catch (Exception $e) {
  echo "Error connection to db: ". $e->getMessage();
}
?>

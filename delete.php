<?php 

require_once "config/db.php";
if(!isset($_GET["id"])){
  header("Location: index.php");
  exit;
}

//using the employee id to delete them
$id = $_GET["id"];
$sql = "DELETE FROM staff WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: index.php");
exit;
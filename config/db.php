<?php

$conn = mysqli_connect(
  "localhost",
  "root",
  "LCAsqlPASSWORD97",
  'afristaff_db',
  3307
);

if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
}

?>
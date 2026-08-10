<?php

//use database

require_once "config/db.php";


//calling the database values with http methods
//and check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST"){
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $department = $_POST["department"];
  $email = $_POST["email"];

  $sql = "INSERT INTO staff (first_name, last_name, department, email)
  VALUES (?, ?, ?, ?)";


$stmt = $conn->prepare($sql);

//bind 4 strings
$stmt->bind_param(
  "ssss",
  $first_name,
  $last_name,
  $department,
  $email
);

$stmt->execute();

//close the connection after using it
$stmt->close();


header("Location: index.php");
exit;
}

?>

<!Doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewpoint" content="width=device-width, inital-scale=1.0">

    <title>AfriStaff - Add Staff</title>
    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <div class="container">
      <h1>Add New Staff Memeber</h1>
      <form method="POST" action="add.php">
        <label for="first_name">First Name</label>
        <input
          type="text"
          id="first_name"
          name="first_name"
          required
        >
        <label for="last_name">Last Name</label>
        <input
          type="text"
          id="last_name"
          name="last_name"
          require
        >

        <label for="department">Department</label>
        <input
          type="text"
          id="department"
          name="department"
          required
        >

        <label for="email">Email</label>
        <input
          type="email"
          id="email"
          name="email"
          required
        >

        <button type="submit">Add Staff</button>
        <a href="index.php">Cancel</a>
      </form>
    </div>
  </body>
</html>
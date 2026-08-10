<?php
require_once "config/db.php";

if (!isset($_GET["id"])){
  header("Location: index.php");
  exit;
}

$id = $_GET["id"];

//GET the selected staff member
$sql = "SELECT * FROM staff WHERE id =?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$staff = $result->fetch_assoc();

$stmt->close();

//If the staff member does not exitst
if (!$staff){
  header("Location: index.php");
  exit;
}

//handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST"){
  $first_name = $_POST["first_name"];
  $last_name = $_POST["last_name"];
  $department = $_POST["department"];
  $email = $_POST["email"];

  $sql = "UPDATE staff
          SET first_name = ?, last_name = ?, department =?, email =?
          WHERE id = ?";

  $stmt = $conn->prepare($sql);

  $stmt->bind_param(
    "ssssi",
    $first_name,
    $last_name,
    $department,
    $email,
    $id
  );

  $stmt->execute();
  $stmt->close();

  header("Location: index.php");
  exit;
}

?>


<!doctype html>
<html lang="en">
  <head>
      <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AfriStaff - Edit Staff</title>

    <link rel="stylesheet" href="style.css">
  </head>

  <body>
    <div class="container">
      <h1>Edit Staff Memeber</h1>
      <form method="POST" action="edit.php?id=<?php echo $staff["id"]; ?>">
        <label for="first_name">First Name</label>
        <input
          type="text"
          id="first_name"
          name="first_name"
          value="<?php echo htmlspecialchars($staff["first_name"]); ?>"
        >

        <label for="last_name">Last Name</label>
        <input
          type="text"
          id="last_name"
          name="last_name"
          value="<?php echo htmlspecialchars($staff["last_name"]); ?>"
        >


        <label for="department">Department</label>
        <input
          type="text"
          id="department"
          name="department"
          value="<?php echo htmlspecialchars($staff["department"]); ?>"
        >

        <label for="email">Email</label>
        <input
          type="email"
          id="email"
          name="email"
          value="<?php echo htmlspecialchars($staff["email"]); ?>"
        >

        <button type="submit">Update Staff</button>
        <a href="index.php">Cancel</a>
      </form>
    </div>
  </body>
</html>
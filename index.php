<?php

//import the connection to the database
require_once "config/db.php";

//get all the staff records
$sql = "SELECT * FROM staff ORDER BY id DESC";
$result = mysqli_query($conn, $sql);


?>


<!-- html structure-->
 <!DOCTYPE html>
 <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <title>AfriStaff - Staff Directory</title>
    <link rel="stylesheet" href="style.css">
  </head>


  <body>
    <div class="container">
      <h1>AfriStaff</h1>
      <p class="subtitle">Staff Directory</p>
      <a href="add.php" class="button">+ Add New Staff</a>

      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Department</th>
            <th>Email</th>
            <th>Created</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($result) >0): ?>
            <?php while ($staff = mysqli_fetch_assoc($result)): ?>

              <tr>
                <td><?php echo $staff["id"];?></td>

                <td>
                  <?php echo htmlspecialchars($staff["first_name"]); ?>
                </td>

                <td>
                  <?php echo htmlspecialchars($staff["last_name"]); ?>
                </td>

                <td>
                  <?php echo htmlspecialchars($staff["department"]); ?>

                </td>

                <td>
                  <?php echo htmlspecialchars($staff["email"]); ?>
                </td>

                <td>
                  <?php echo $staff["created_at"]; ?>
                </td>

                <td>
                  <a href="edit.php?id=<?php echo $staff["id"]; ?>">Edit</a>

                  |

                  <a
                    href="delete.php?id=<?php echo $staff["id"]; ?>"
                    onclick="return confirm('Are you sure you want to delete this staff member?');"
                  > Delete </a>
                </td>
              </tr>

            <?php endwhile; ?>

          <?php else: ?>
            <tr>
              <td colspan="7">No staff records found
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </body>
 </html>

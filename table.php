<?php
session_start();
// var_dump($_SESSION);

include_once "User.php";

$user = new User(new Database());

$result = $user->getUsers();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <div class="content-container">
            <h1 class="user">Hello, 
                <?php
                if (isset($_SESSION['name'])) {
                    echo $_SESSION['name'];
                }
                ?>
            </h1>
            <h2>User Table</h2>
            <table border="1">
                <tr>
                    <th>Matric</th>
                    <th>Name</th>
                    <th>Level</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php
                while($row = $result->fetch_assoc()) {
                    echo 
                    "<tr>
                        <td>" . $row['matric'] . "</td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['role'] . "</td>
                        <td><a href='update.php?matric=". $row['matric'] ." '>Update</a></td>
                        <td><a href='delete.php?matric=". $row['matric'] ." '>Delete</a></td>
                    </tr>";
                }
                ?>
            </table>

            <div class="input-container">
                <a href="logout.php">Log Out</a>
            </div>
        </div>
    </section>
</body>
</html>
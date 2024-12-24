<?php
session_start();

include_once 'User.php';
include_once "Database.php";

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    $db = new Database();
    $user = new User(new Database());
    

    $sql = "SELECT matric, name, role FROM users WHERE matric = ?";
    $stmt = $db->getConnection()->prepare($sql);
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();

    // If the user is found, display the form with existing data
    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    } else {
        header("Location: table.php?error=User not found");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the new data from the form
        $name = $_POST['name'];
        $role = $_POST['role'];

        // Call the updateUser function
        $updateResult = $user->updateUser($matric, $name, $role);

        if ($updateResult === true) {
            header("Location: table.php");
            exit;
        } else {
            $error = $updateResult;
        }
    }
} else {
    header("Location: table.php?error=Invalid User");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <form class="content-container" action="" method="POST">
            <h1>Update User</h1>
            <div class="input-container">
                <label for="name">Name</label>
                <input type="text" name="name" value="<?php echo $userData['name']; ?>" required>
            </div>
            <div class="input-container">
                <label for="role">Role</label>
                <select name="role" id="" required>
                <option value="lecturer" <?php if ($userData['role'] == 'lecturer') echo 'selected'; ?>>Lecturer</option>
                <option value="student" <?php if ($userData['role'] == 'student') echo 'selected'; ?>>Student</option>
                </select>
            </div>
            <button type="submit">Update</button>

            <div class="input-container">
                <a href="table.php">Cancel</a>
            </div>
        </form>
    </section>
</body>
</html>
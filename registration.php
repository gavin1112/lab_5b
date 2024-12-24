<?php
include_once 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['matric']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['role'])) {

        $matric = $_POST['matric'];
        $name = $_POST['name'];
        $password = $_POST['password'];
        $role = $_POST['role'];

        $user = new User(new Database());
        $result = $user->newUser($matric, $name, $password, $role);

        if ($result === true) {
            header("Location: login.php");        
        // } else {
        //     echo "Error: " . $result;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
        <form class="content-container" action="" method="POST">
            <h1>Register</h1>
            <div class="input-container">
                <label for="matric">Matric</label>
                <input type="text" name="matric" id="" required>
            </div>
            <div class="input-container">
                <label for="name">Name</label>
                <input type="text" name="name" id="" required>
            </div>
            <div class="input-container">
                <label for="password">Password</label>
                <input type="password" name="password" id="" required>
            </div>
            <div class="input-container">
                <label for="role">Role</label>
                <select name="role" id="" required>
                    <option value="">Please Select</option>
                    <option value="lecturer">Lecturer</option>
                    <option value="student">Student</option>
                </select>
            </div>
            <button type="submit">Submit</button>

            <div class="input-container">
                <a href="login.php">Log In</a>
            </div>
        </form>
    </section>
</body>
</html>
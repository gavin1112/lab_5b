<?php
include_once "Database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$db = new Database();
$conn = $db->getConnection();

//get form data
$matric = $_POST['matric'];
$password = $_POST['password'];

$sql = "SELECT matric, name, password FROM users WHERE matric = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $matric);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {

        $_SESSION['matric'] = $user['matric'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        header("Location: table.php");
        exit;
    } else {
        header("Location: error.php");
        exit;
    }
} else {
    header("Location: error.php");
    exit;
}

$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section>
            <form class="content-container" action="" method="post">
                <h1>Log In</h1>

                <div class="input-container">
                    <label for="matric">Matric</label>
                    <input type="text" name="matric" id="" required>
                </div>
                <div class="input-container">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="" required>
                </div>

                <button type="submit">Login</button>

                <div class="input-container">
                    <a href="registration.php">Register here if you have not.</a>
                </div>
            </form>
        </div>
    </section>
</body>
</html>
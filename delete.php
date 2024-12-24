<?php
include_once 'User.php';

if (isset($_GET['matric'])) {
    $matric = $_GET['matric'];

    $user = new User(new Database());

    $result = $user->deleteUser($matric);

    if ($result === true) {
        // If deletion was successful, redirect to table.php with success message
        header("Location: table.php");
    } else {
        // If deletion failed, redirect back to table.php with error message
        header("Location: table.php?error=" . urlencode($result));
    }
    exit;
} else {
    // If no matric is provided, redirect to table.php with error message
    header("Location: table.php?error=Invalid User");
    exit;
}
?>
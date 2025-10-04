<?php
session_start();
require_once 'dbcon.php'; 

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $full_name = ($_POST['full_name']);
    $email     = ($_POST['email']);
    $password  = $_POST['password'];
    $phone  = $_POST['phone'];

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("insert into users (full_name, email, password,phone) VALUES (?, ?, ?,?)");
    if(!$stmt){
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("ssss", $full_name, $email, $hash,$phone);

    if($stmt->execute()){

        $_SESSION = array();

        session_destroy();

        session_start();
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['full_name'] = $full_name;
        $_SESSION['user'] = 'user';
        header('Location: index.php');
        // echo "Signup successful. Welcome, " . htmlspecialchars($full_name) . "!";
    } else {
        if(strpos($stmt->error, "Duplicate") !== false){
            echo "Email already registered.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    $stmt->close();
}
?>

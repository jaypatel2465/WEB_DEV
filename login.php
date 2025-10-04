<?php
session_start();
require_once 'dbcon.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("select user_id, full_name, password from users where email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $full_name, $hash);

    if($stmt->fetch()){
        if(password_verify($password, $hash)){
            if(password_needs_rehash($hash, PASSWORD_DEFAULT)){
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $upd = $conn->prepare("update users set password = ? where user_id = ?");
                $upd->bind_param("si", $newHash, $user_id);
                $upd->execute();
                $upd->close();
            }

            session_regenerate_id(true);
            $_SESSION['user_id'] = $user_id;
            $_SESSION['full_name'] = $full_name;
            $_SESSION['user'] = 'user';

            header('Location: index.php');
        } else {
            echo "Invalid email or password.";
        }
    } else {
        echo "Invalid email or password.";
    }

    $stmt->close();
}
?>
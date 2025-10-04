<?php
session_start();
require_once 'dbcon.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(empty($email) || empty($password)){
        die("Email and password required.");
    }

    $stmt = $conn->prepare("select company_id, company_name, password from companies where email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($company_id, $company_name, $hash);

    $hash = trim($hash);

    if($stmt->fetch()){
        if(password_verify($password, $hash)){

            session_regenerate_id(true);
            $_SESSION['company_id'] = $company_id;
            $_SESSION['company_name'] = $company_name;
            $_SESSION['type'] = 'company';

            header("Location: admin.php");
            exit();
        } else {
            echo "Password incorrect.";
        }
    } else {
        echo "Email is not registered.";
    }

    $stmt->close();
}
?>

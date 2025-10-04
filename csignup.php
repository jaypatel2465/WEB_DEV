<?php
session_start();
require_once 'dbcon.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $company_name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("insert into companies (company_name, email, password) VALUES (?, ?, ?)");
    if(!$stmt){
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("sss", $company_name, $email, $hash);

    if($stmt->execute()){
        // Store session info
        $_SESSION = array();

        session_destroy();

        session_start();
        $_SESSION['company_id'] = $stmt->insert_id;
        $_SESSION['company_name'] = $company_name;
        $_SESSION['company'] = 'company';

        // Redirect to company dashboard/home page
        header("Location: admin.php");
        exit();
    } else {
        if(strpos($stmt->error, "Duplicate") !== false){
            echo "Email or company name already registered.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
?>

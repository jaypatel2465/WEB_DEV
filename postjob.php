<?php
// 1. Start the session and include the database connection
session_start();
require_once 'dbcon.php';


if (!isset($_SESSION['company'])) {
        header('Location: clogin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $company_id = $_SESSION['company_id'];
    $job_title = $_POST['jobTitle'];
    $role_desc = $_POST['jobDesc'];
    $experience = $_POST['jobExp'];
    $skills = $_POST['skills'];
    $salary = $_POST['salary'];

    $sql = "INSERT INTO jobs (company_id, job_title, role, experience_required, skills, salary_range) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("isssss", $company_id, $job_title, $role_desc, $experience, $skills, $salary);

    if ($stmt->execute()) {
        header('Location: admin.php?status=success');
        exit();
    } else {
        echo "Error: Could not post the job. Please try again.";
    }

    $stmt->close();
} else {
    header('Location: admin.php');
    exit();
}
?>
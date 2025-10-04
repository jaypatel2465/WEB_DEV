<?php
  require_once 'dbcon.php';
  session_start();

    if($_SERVER['REQUEST_METHOD']=="GET"){
        // echo "Inside";
        $app_id = $_GET['app'];
        $status = $_GET['sta'];

        if($status == "a")
            $status = "Shortlisted";
        else if($status = "r")
            $status = "Rejected";

        $sql = "update applications set status=? where application_id=?";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("si",$status,$app_id);

        if ($stmt->execute()) {
            header('Location: admin.php');
            exit();
        } else {
            echo "Error: Could not post the job. Please try again.";
        }
    }
?>
<?php
  require_once 'dbcon.php';
  session_start();

  if(!isset($_SESSION['user'])){
      header('Location: logi.php');
  }
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $dir = "resumes/";
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $resume = $_POST['resume'];
        $cover = $_POST['cover'];
        $job_id = $_POST['job_id'];

        $user_id = $_SESSION['user_id'];
        $name = $_SESSION['full_name'];
        
        if(!is_dir($dir)){
            mkdir($dir);
        }

        $des = $email. $_POST['job_id'];
        $resume=$dir.$des.".pdf";


        if(move_uploaded_file($_FILES["resume"]["tmp_name"],$resume)){
            echo "The file was Uploaded Successfully.";
        }
        else{
            echo "File upload failed.";
        }

        $sql = "INSERT INTO applications (job_id, user_id,name, phone, resume, cover_letter) VALUES (?,?,?,?,?,?)";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("iissss",$job_id,$user_id,$name,$phone,$resume,$cover);

        if ($stmt->execute()) {
            header('Location: jobs.php');
            exit();
        } else {
            echo "Error: Could not post the job. Please try again.";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apply - JobConnect</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <nav class="navbar">
    <div class="nav-container">
      <div class="nav-logo">
        <a href="index.php">JobConnect</a>
      </div>
      <div class="nav-menu">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="jobs.php">Jobs</a></li>
          <li><a href="admin.php">Admin</a></li>
          <li><a href="login.html">Login</a></li>
          <li><a href="signup.html">Signup</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="form-container">
    <div class="card">
        <div class="card-header">
            <h1>Apply for <?=$_GET['role'] ?></h1>
        </div>
        <form id="applyForm" action="apply.php" method="post" enctype="multipart/form-data">
            <label>Full Name: 
                <input type="text" id="applyName" name="name" required>
                <input type="hidden" id="applyName" name="job_id" value=<?= $_GET['job_id'] ?> required>
                <span class="error" id="applyNameError"></span>
            </label>
            <label>Email: 
                <input type="email" name="email" id="applyEmail" required>
                <span class="error" id="applyEmailError"></span>
            </label>
            <label>Phone: 
                <input type="tel" name="phone" id="applyPhone" required>
                <span class="error" id="applyPhoneError"></span>
            </label>
             <label>Resume/CV: 
                <input type="file" name="resume" id="applyResume" required>
                <span class="error" id="applyResumeError"></span>
            </label>
            <label>Cover Letter or description: 
                <textarea id="applyCover" name="cover" rows="5" required></textarea>
                <span class="error" id="applyCoverError"></span>
            </label>
            <button type="submit">Submit Application</button>
        </form>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 JobConnect. All rights reserved.</p>
  </footer>

  <!-- <script src="script.js" defer></script> -->
</body>
</html>


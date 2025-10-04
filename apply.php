<?php
  session_start();

  if(!isset($_SESSION['user'])){
      header('Location: signu.php');
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
        <a href="index.html">JobConnect</a>
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
            <h1>Apply for Senior Software Engineer</h1>
        </div>
        <form id="applyForm">
            <label>Full Name: 
                <input type="text" id="applyName" required>
                <span class="error" id="applyNameError"></span>
            </label>
            <label>Email: 
                <input type="email" id="applyEmail" required>
                <span class="error" id="applyEmailError"></span>
            </label>
            <label>Phone: 
                <input type="tel" id="applyPhone" required>
                <span class="error" id="applyPhoneError"></span>
            </label>
             <label>Resume/CV: 
                <input type="file" id="applyResume" required>
                <span class="error" id="applyResumeError"></span>
            </label>
            <label>Cover Letter: 
                <textarea id="applyCover" rows="5" required></textarea>
                <span class="error" id="applyCoverError"></span>
            </label>
            <button type="submit">Submit Application</button>
        </form>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 JobConnect. All rights reserved.</p>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>


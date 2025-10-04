<?php
  require_once "dbcon.php";
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup - JobConnect</title>
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
          <li><a href="logi.php">Login</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="form-container">
    <div class="card">
        <div class="card-header">
            <h1>Create Your Account</h1>
        </div>
        <form id="signupForm" action="signup.php" method="post">
            <label>Full Name: 
                <input type="text" id="fullName" name="full_name" required>
                <span class="error" id="nameError"></span>
            </label>
            <label>Email: 
                <input type="email" id="email" name="email" required>
                <span class="error" id="emailError"></span>
            </label>
            <label>Phone Number: 
                <input type="number" id="phone" name="phone" required>
                <span class="error" id="phonrError"></span>
            </label>
            <label>Password: 
                <input type="password" id="password" name="password" required>
                <span class="error" id="passwordError"></span>
            </label>
            <label>Confirm Password: 
                <input type="password" id="confirmPassword" required>
                <span class="error" id="confirmError"></span>
            </label>
            <button type="submit">Register</button>
        </form>
        <p class="form-footer">
            Already have an account? <a href="logi.php">Login</a>
        </p>
    </div>
  </main>
  
  <footer>
    <p>&copy; 2025 JobConnect. All rights reserved.</p>
  </footer>

  <!-- <script src="script.js" defer></script> -->
</body>
</html>

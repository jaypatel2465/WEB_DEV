<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - JobConnect</title>
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
            <h1>Welcome Back Recruiter!</h1>
        </div>
        <form id="loginForm" action="clogin.php" method="post">
            <label>Email: 
                <input type="email" name="email" id="loginEmail" required>
                <span class="error" id="loginEmailError"></span>
            </label>
            <label>Password: 
                <input type="password" name="password" id="loginPassword" required>
                <span class="error" id="loginPasswordError"></span>
            </label>
            <button type="submit">Login</button>
        </form>
        <p class="form-footer">
            Don't have an account? <a href="signup.html">Sign up</a> | <a href="#">Forgot Password?</a>
        </p>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 JobConnect. All rights reserved.</p>
  </footer>

  <!-- <script src="script.js" defer></script> -->
</body>
</html>

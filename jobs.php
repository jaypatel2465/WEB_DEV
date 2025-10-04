<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jobs - JobConnect</title>
  
  <!-- General Styles (from style.css) are placed here first -->
  <style>
    /* General body and typography */
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
        color: #333;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    /* Header and Navigation */
    .navbar {
        width: 100%;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        padding: 0 1rem;
        box-sizing: border-box;
    }

    .nav-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1200px;
        margin: 0 auto;
        height: 60px;
    }

    .nav-logo a {
        color: #007bff;
        text-decoration: none;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .nav-menu ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        gap: 1.5rem;
    }

    .nav-menu a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .nav-menu a:hover {
        color: #007bff;
    }

    /* Main Content Area */
    main {
        flex-grow: 1;
    }
    
    /* Shared Card Style */
    .job-card {
        background: #ffffff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        border: 1px solid #e9ecef;
    }

    /* General button styles */
    button {
        padding: 0.75rem 1.5rem;
        border: none;
        background-color: #007bff;
        color: white;
        cursor: pointer;
        border-radius: 5px;
        font-size: 1rem;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    /* Footer */
    footer {
        background: #343a40;
        color: #fff;
        text-align: center;
        padding: 1.5rem;
        margin-top: auto;
    }
  </style>

  <!-- Styles SPECIFICALLY for this page to ensure correct layout -->
  <style>
    .content-container {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 3rem 1rem;
      box-sizing: border-box;
    }
    
    .page-title {
        text-align: center;
        margin-bottom: 2.5rem;
        font-size: 2.5rem;
        font-weight: bold;
        color: #343a40;
    }

    .jobs-list {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
      max-width: 800px;
      margin: 0 auto;
    }

    .job-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0,0,0,0.1);
    }
  </style>
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

  <main class="content-container">
    <h1 class="page-title">Available Jobs</h1>
    <div class="jobs-list">
      <div class="job-card">
        <h3>Senior Software Engineer</h3>
        <p>TechCorp Inc. - San Francisco, CA</p>
        <p>Develop and maintain our cutting-edge web applications using modern technologies.</p>
        <a href="apply.html"><button>Apply Now</button></a>
      </div>
      <div class="job-card">
        <h3>Product Manager</h3>
        <p>Innovate Solutions - New York, NY</p>
        <p>Lead the product vision and roadmap for our flagship SaaS product.</p>
        <a href="apply.html"><button>Apply Now</button></a>
      </div>
      <div class="job-card">
        <h3>UX/UI Designer</h3>
        <p>Creative Minds - Remote</p>
        <p>Design intuitive and beautiful user interfaces for our mobile and web platforms.</p>
        <a href="apply.html"><button>Apply Now</button></a>
      </div>
      <div class="job-card">
        <h3>Data Analyst</h3>
        <p>Numbers Co. - London, UK</p>
        <p>Analyze large datasets to identify trends and provide actionable insights.</p>
        <a href="apply.html"><button>Apply Now</button></a>
      </div>
    </div>
  </main>

  <footer>
    <p>&copy; 2025 JobConnect. All rights reserved.</p>
  </footer>
</body>
</html>



<?php
  require_once 'dbcon.php';

  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jobs - JobConnect</title>
  

  <style>

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
    
    .job-card {
        background: #ffffff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin: 1rem 3rem;
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

    .content-container {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 1rem 1rem;
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
        <a href="index.php">JobConnect</a>
      </div>
      <div class="nav-menu">
      <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="jobs.php">Jobs</a></li>
          <li><a href="admin.php">Admin</a></li>
          <li><a href="signu.php">Signup</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="content-container">
    <h1 class="page-title">Available Jobs</h1>
    <?php
    $sql = "SELECT 
                j.job_id,
                j.job_title,
                j.role,
                j.experience_required,
                j.skills,
                j.salary_range,
                u.company_name
            FROM 
                jobs AS j
            JOIN 
                companies AS u ON j.company_id = u.company_id
            ORDER BY 
                j.created_at DESC";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {

        while ($job = $result->fetch_assoc()) {
            ?>
            <div class="job-card">
                <h3><?php echo $job['job_title'] ." - ".$job['company_name']; ?></h3>
                <p><?php echo $job['role']; ?></p>
                
                <div class="details">
                    <p><strong>Experience:</strong> <?php echo ($job['experience_required']); ?> years</p>
                    <p><strong>Skills:</strong> <?php echo ($job['skills']); ?></p>
                    <p><strong>Salary:</strong> <?php echo ($job['salary_range']); ?></p>
                </div>

                <a href="apply.php?job_id=<?=$job['job_id'] ?>&role=<?=$job['job_title'] ?>"><button>Apply Now</button></a>
            </div>
            <?php
        }
    } else {
        // 4. Display a message if no jobs are found
        echo '<p class="no-jobs">No job vacancies found at the moment.</p>';
    }

    // Close the database connection
    $conn->close();
    ?>
    <!-- <div class="jobs-list">
      <div class="job-card">
        <h3>Senior Software Engineer</h3>
        <p>TechCorp Inc. - San Francisco, CA</p>
        <p>Develop and maintain our cutting-edge web applications using modern technologies.</p>
        <a href="apply.html"><button>Apply Now</button></a>
      </div>
    </div> -->
  </main>

  <footer>
    <p>&copy; 2025 JobConnect. All rights reserved.</p>
  </footer>
</body>
</html>



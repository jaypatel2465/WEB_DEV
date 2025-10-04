<?php
  require_once 'dbcon.php';
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JobConnect - Home</title>
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
          <li><a href="signup.html">Signup</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <main>
    <section class="hero">
      <h2>Welcome, <?= isset($_SESSION['user']) ? $_SESSION['full_name'] : (isset($_SESSION['company']) ? $_SESSION['company_name'] :'User') ?></h2>
      <h2>Connecting Talent with Opportunity</h2>
      <div class="stats">
        <div><span id="jobsCount">
        <?php
        $sql = "select count(*) as co from jobs";
        $res = $conn->query($sql);
        if($res){
          $row = $res->fetch_assoc();
          echo $row["co"];
        }
        ?>
        </span><p>Jobs Available</p></div>
        <div><span id="companiesCount">
        <?php
        $sql = "select count(*) as co from companies";
        $res = $conn->query($sql);
        if($res){
          $row = $res->fetch_assoc();
          echo $row["co"];
        }
        ?>
        </span><p>Companies Hiring</p></div>
        <div><span id="usersCount">
        <?php
        $sql = "select count(*) as co from users";
        $res = $conn->query($sql);
        if($res){
          $row = $res->fetch_assoc();
          echo $row["co"];
        }
        ?>
        </span><p>Registered Users</p></div>
      </div>
    </section>

    
<section class="featured">
    <h3>Featured Companies</h3>
    <div class="company-logos">
        <?php
        $sql = "SELECT 
                    c.company_name, 
                    COUNT(j.job_id) AS job_count 
                FROM 
                    jobs AS j
                JOIN 
                    companies AS c ON j.company_id = c.company_id
                GROUP BY 
                    c.company_id, c.company_name
                ORDER BY 
                    job_count DESC
                LIMIT 4";

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="logo">' . $row['company_name'] . '</div>';
            }
        } else {
            echo '<p>No featured companies at this time.</p>';
        }

        $conn->close();
        ?>
    </div>
</section>
  </main>
  
  <footer>
    <p>&copy; 2025 JobConnect. All rights reserved.</p>
  </footer>

  <script src="script.js" defer></script>
</body>
</html>

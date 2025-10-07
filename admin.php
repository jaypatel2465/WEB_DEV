<?php
  require_once "dbcon.php";
  session_start();

  if(!isset($_SESSION['company'])){
      header('Location: csignu.php');
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - JobConnect</title>
  
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
    main { flex-grow: 1; }
    button { cursor: pointer; transition: background-color 0.3s ease; }
    .card {
        background: #ffffff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        border: 1px solid #e9ecef;
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
    }
    .nav-menu a:hover { color: #007bff; }

    footer {
        background: #343a40;
        color: #fff;
        text-align: center;
        padding: 1.5rem;
        margin-top: auto;
    }

    .content-container {
      width: 100%;
      max-width: 960px;
      margin: 0 auto;
      padding: 2rem 1rem;
      box-sizing: border-box;
    }
    .dashboard-header {
      text-align: center;
      margin-bottom: 2rem;
    }
    .dashboard-header h1 {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
    }
    .tab-switcher {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-bottom: 2rem;
    }
    .tab-btn {
      font-size: 1rem;
      padding: 0.6rem 1.2rem;
      border: 1px solid #dee2e6;
      background-color: #f8f9fa;
      color: #333;
      border-radius: 5px;
    }
    .tab-btn.active {
      background-color: #007bff;
      color: white;
      border-color: #007bff;
    }
    .tab-content { display: none; }
    .tab-content.active { display: block; }
    
    /* Form Styles */
    .form-group { margin-bottom: 1.5rem; }
    .form-group label {
        display: block;
        margin-bottom: .5rem;
        font-weight: 500;
    }
    .form-group input, .form-group textarea {
        width: 100%;
        padding: .75rem;
        border: 1px solid #ced4da;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 1rem;
        font-family: inherit;
    }
    #postJobForm button {
        width: 100%;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        font-weight: 500;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: white;
    }
    #postJobForm button:hover { background-color: #0056b3; }

    /* Manage Jobs List */
    .posted-job {
        border-bottom: 1px solid #e9ecef;
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .posted-job:last-child {
        border-bottom: none;
        margin-bottom: 0;
    }
    .applicant-list { margin-top: 1rem; }
    .applicant {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem;
        border-radius: 4px;
        background-color: #f8f9fa;
        margin-bottom: 0.5rem;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .applicant.accepted { background-color: #d4edda; color: #155724; }
    .applicant.rejected { background-color: #f8d7da; color: #721c24; }
    
    .applicant-actions button {
        margin-left: 0.5rem;
        padding: 0.4rem 0.8rem;
        font-size: 0.875rem;
        border: none;
        border-radius: 4px;
        color: white;
    }
    .btn-accept, .ba { background-color: #28a745; }
    .btn-accept:hover { background-color: #218838; }
    .btn-reject, .br { background-color: #dc3545; }
    .btn-reject:hover { background-color: #c82333; }

    .a:visited{
      color: blue;
    }

    
.suc{
    color: green;
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
    <div class="dashboard-header">
      <h1><?= $_SESSION['company_name'] ?> Dashboard</h1>
      <p>Post new jobs and manage applications from candidates.</p>
    </div>

    <div class="tab-switcher">
      <button id="post-job-btn" class="tab-btn active">Post a New Job</button>
      <button id="manage-job-btn" class="tab-btn">Manage Job Posts</button>
    </div>

    <!-- Post a Job Section -->
    <section id="post-job-content" class="tab-content active">
      <div class="card">
      <?php
    if (isset($_GET['status']) && $_GET['status'] === 'success') {
        echo '<div class="suc">Job Posted succesfully</div>';
    }
    ?>
        <h2>Post a New Vacancy</h2>
        <form id="postJobForm" method="post" action="postjob.php">
          <div class="form-group">
            <label for="jobTitle">Job Title</label>
            <input type="text" id="jobTitle" name="jobTitle" required>
          </div>
          <div class="form-group">
            <label for="jobDesc">Role Description</label>
            <textarea id="jobDesc" rows="5" name="jobDesc" required></textarea>
          </div>
          <div class="form-group">
            <label for="jobExp">Required Experience (in years)</label>
            <input type="number" id="jobExp" name="jobExp" required>
          </div>
          <div class="form-group">
            <label for="jobSkills">Required Skills (comma-separated)</label>
            <input type="text" id="jobSkills" name="skills" required>
          </div>
          <div class="form-group">
            <label for="jobSalary">Salary Range</label>
            <input type="text" id="jobSalary" name="salary" required>
          </div>
          <button type="submit">Post Job</button>
        </form>
      </div>
    </section>

    <section id="manage-job-content" class="tab-content">
      <div class="card">
        <h2>Manage Posted Jobs</h2>
        <?php
          $sql = "SELECT
          j.job_id,
          j.job_title,
          a.application_id,
          a.status,
          a.name AS applicant_name,
          a.resume AS resume_path,
          a.cover_letter
      FROM
          jobs AS j
      JOIN
          applications AS a ON j.job_id = a.job_id
      WHERE
          j.company_id = ?
      ORDER BY
          j.job_title, a.applied_at DESC";

          $stmt = $conn->prepare($sql);
          $stmt->bind_param("i", $_SESSION['company_id']);
          $stmt->execute();
          $result = $stmt->get_result();

          while ($row = $result->fetch_assoc()) {
            $jobs_with_applicants[$row['job_id']]['job_title'] = $row['job_title'];
            $jobs_with_applicants[$row['job_id']]['applicants'][] = $row;
        }
    
        // 4. DYNAMIC HTML GENERATION
        if (empty($jobs_with_applicants)) {
            echo "<p>No applications received yet.</p>";
        } else {
            foreach ($jobs_with_applicants as $job) {
                ?>
                <div class="posted-job">
                    <h3><?= $job['job_title'] ?></h3>
                    <div class="applicant-list">
                        <?php foreach ($job['applicants'] as $applicant) { ?>
                            <div class="applicant">
                                <div class="applicant-info">
                                    <span><?= $applicant['applicant_name'] ?></span>
                                    <div>
                                        <a href="<?= $applicant['resume_path'] ?>" target="_blank">View Resume</a>
                                    </div>
                                        <p>"<?= $applicant['cover_letter'] ?>"</p>
                                </div>
                                <div class="applicant-actions">
                                  <?php if($applicant['status'] == 'Applied'){
                                    ?>
                                    <a href="status.php?app=<?= $applicant['application_id'] ?>&sta=a" ><button class="btn-accept">Accept</button></a>
                                    <a href="status.php?app=<?= $applicant['application_id'] ?>&sta=r" ><button class="btn-reject">Reject</button></a>
                                    <?php
                                  }else if($applicant['status'] == 'Rejected'){
                                    echo "<button class='br'>".$applicant['status']."</button>";
                                  }else{
                                    echo "<button class='ba'>".$applicant['status']."</button>";
                                  }
                                    ?>
                                  </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php
            }
        }
        $stmt->close();
        $conn->close();
        ?>
      </div>
    </section>
  </main>

  <footer>
    <p>&copy; 2025 JobConnect. All rights reserved.</p>
  </footer>
  <script src="script.js"></script>
</body>
</html>



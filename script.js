// Wait for the HTML document to be fully loaded before running the script
document.addEventListener("DOMContentLoaded", () => {
  
  // --- Signup Form Validation ---
  const signupForm = document.getElementById("signupForm");
  if (signupForm) {
    signupForm.addEventListener("submit", e => {
      e.preventDefault();
      // Placeholder for signup validation logic
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirmPassword").value;
      const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
      
      const passwordError = document.getElementById("passwordError");
      const confirmError = document.getElementById("confirmError");

      if (passwordError) {
        passwordError.innerText = passwordRegex.test(password) ? "" : "Password is not strong enough.";
      }
      if (confirmError) {
        confirmError.innerText = password === confirmPassword ? "" : "Passwords do not match";
      }
    });
  }

  // --- Login Form Validation ---
  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", e => {
      e.preventDefault();
      // Placeholder for login validation logic
      console.log("Login form submitted");
    });
  }

  // --- Application Form Validation ---
  const applyForm = document.getElementById("applyForm");
  if (applyForm) {
    applyForm.addEventListener("submit", e => {
      e.preventDefault();
      // Placeholder for application form validation logic
      console.log("Application form submitted");
    });
  }

  // --- Admin Page Functionality ---
  const postJobBtn = document.getElementById('post-job-btn');
  const manageJobBtn = document.getElementById('manage-job-btn');
  const postJobContent = document.getElementById('post-job-content');
  const manageJobContent = document.getElementById('manage-job-content');

  // Only run the admin script if the necessary elements are on the page
  if (postJobBtn && manageJobBtn && postJobContent && manageJobContent) {
    
    // Function to switch between tabs
    function switchTab(activeBtn, inactiveBtn, activeContent, inactiveContent) {
        activeContent.classList.add('active');
        inactiveContent.classList.remove('active');
        activeBtn.classList.add('active');
        inactiveBtn.classList.remove('active');
    }

    // Event listener for the "Post a New Job" button
    postJobBtn.addEventListener('click', () => {
      switchTab(postJobBtn, manageJobBtn, postJobContent, manageJobContent);
    });

    // Event listener for the "Manage Job Posts" button
    manageJobBtn.addEventListener('click', () => {
      switchTab(manageJobBtn, postJobBtn, manageJobContent, postJobContent);
    });

    // Use event delegation to handle clicks on Accept/Reject buttons
    manageJobContent.addEventListener('click', (e) => {
      const target = e.target;
      
      // Check if a button inside the actions container was clicked
      if (target.tagName === 'BUTTON' && target.closest('.applicant-actions')) {
        const applicantDiv = target.closest('.applicant');
        const actionsDiv = target.closest('.applicant-actions');
        
        // Remove any existing status classes
        applicantDiv.classList.remove('accepted', 'rejected');

        // Handle "Accept" button click
        if (target.classList.contains('btn-accept')) {
            applicantDiv.classList.add('accepted');
            actionsDiv.innerHTML = `<strong>Accepted</strong>`;
        } 
        // Handle "Reject" button click
        else if (target.classList.contains('btn-reject')) {
            applicantDiv.classList.add('rejected');
            actionsDiv.innerHTML = `<strong>Rejected</strong>`;
        }
      }
    });
  }
});


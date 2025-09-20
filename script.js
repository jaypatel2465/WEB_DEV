// Main script for JobConnect
document.addEventListener("DOMContentLoaded", () => {
  handleSignupForm();
  handleLoginForm();
  handleApplyForm();
  handleAdminForm();
});

// --- Form Handlers ---

function handleSignupForm() {
  const signupForm = document.getElementById("signupForm");
  if (signupForm) {
    signupForm.addEventListener("submit", e => {
      e.preventDefault();
      validateSignup();
    });
  }
}

function handleLoginForm() {
  const loginForm = document.getElementById("loginForm");
  if (loginForm) {
    loginForm.addEventListener("submit", e => {
      e.preventDefault();
      validateLogin();
    });
  }
}

function handleApplyForm() {
    const applyForm = document.getElementById("applyForm");
    if (applyForm) {
        applyForm.addEventListener("submit", e => {
            e.preventDefault();
            if (validateApplyForm()) {
                alert("Application submitted successfully!");
                applyForm.reset();
            }
        });
    }
}


function handleAdminForm() {
    const postJobForm = document.getElementById("postJobForm");
    if (postJobForm) {
        postJobForm.addEventListener("submit", e => {
            e.preventDefault();
            if (validateAdminForm()) {
                addJobToDashboard();
                postJobForm.reset();
            }
        });
    }
}


// --- Validation Functions ---

function validateSignup() {
  let isValid = true;
  // Name validation
  const name = document.getElementById("fullName");
  isValid = validateField(name, "nameError", "Name is required.") && isValid;
  
  // Email validation
  const email = document.getElementById("email");
  isValid = validateEmail(email, "emailError") && isValid;

  // Password validation
  const password = document.getElementById("password");
  const confirmPassword = document.getElementById("confirmPassword");
  isValid = validatePassword(password, confirmPassword, "passwordError", "confirmError") && isValid;
  
  if (isValid) {
    alert("Signup successful!");
    document.getElementById("signupForm").reset();
  }
  return isValid;
}

function validateLogin() {
  let isValid = true;
  const email = document.getElementById("loginEmail");
  isValid = validateEmail(email, "loginEmailError") && isValid;

  const password = document.getElementById("loginPassword");
  isValid = validateField(password, "loginPasswordError", "Password is required.") && isValid;
  
  if (isValid) {
    alert("Login successful!");
    document.getElementById("loginForm").reset();
  }
  return isValid;
}


function validateApplyForm() {
    let isValid = true;
    isValid = validateField(document.getElementById("applyName"), "applyNameError", "Full name is required.") && isValid;
    isValid = validateEmail(document.getElementById("applyEmail"), "applyEmailError") && isValid;
    isValid = validatePhone(document.getElementById("applyPhone"), "applyPhoneError") && isValid;
    isValid = validateField(document.getElementById("applyResume"), "applyResumeError", "Resume is required.") && isValid;
    isValid = validateField(document.getElementById("applyCover"), "applyCoverError", "Cover letter is required.") && isValid;
    return isValid;
}


function validateAdminForm() {
    let isValid = true;
    isValid = validateField(document.getElementById("jobTitle"), "", "Job title is required.") && isValid;
    isValid = validateField(document.getElementById("companyName"), "", "Company name is required.") && isValid;
    isValid = validateField(document.getElementById("jobLocation"), "", "Location is required.") && isValid;
    isValid = validateField(document.getElementById("jobDescription"), "", "Description is required.") && isValid;
    return isValid;
}


// --- Validation Helpers ---

function validateField(field, errorId, message) {
    const errorEl = document.getElementById(errorId);
    if (field.value.trim() === "") {
        if (errorEl) errorEl.textContent = message;
        return false;
    }
    if (errorEl) errorEl.textContent = "";
    return true;
}

function validateEmail(emailField, errorId) {
    const emailRegex = /^[^@]+@[^@]+\.[^@]+$/;
    const errorEl = document.getElementById(errorId);
    if (!emailRegex.test(emailField.value)) {
        errorEl.textContent = "Please enter a valid email address.";
        return false;
    }
    errorEl.textContent = "";
    return true;
}

function validatePassword(passwordField, confirmField, passwordErrorId, confirmErrorId) {
    const passErr = document.getElementById(passwordErrorId);
    const confErr = document.getElementById(confirmErrorId);
    let isValid = true;

    // Regex requires at least 8 characters, one uppercase, one lowercase, one number, and one special character
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;

    if (!passwordRegex.test(passwordField.value)) {
        passErr.textContent = "Password must be 8+ chars and include uppercase, lowercase, number, & special char (@$!%*?&).";
        isValid = false;
    } else {
        passErr.textContent = "";
    }

    if (passwordField.value !== confirmField.value) {
        confErr.textContent = "Passwords do not match.";
        isValid = false;
    } else {
        confErr.textContent = "";
    }
    return isValid;
}

function validatePhone(phoneField, errorId) {
    const phoneRegex = /^\d{10}$/; // Simple 10-digit phone number
    const errorEl = document.getElementById(errorId);
    if (!phoneRegex.test(phoneField.value.trim())) {
        errorEl.textContent = "Please enter a valid 10-digit phone number.";
        return false;
    }
    errorEl.textContent = "";
    return true;
}

// --- Admin Dashboard Functionality ---

function addJobToDashboard() {
    const title = document.getElementById("jobTitle").value;
    const company = document.getElementById("companyName").value;
    const location = document.getElementById("jobLocation").value;

    const list = document.getElementById("postedJobsList");

    const jobDiv = document.createElement("div");
    jobDiv.className = "posted-job";

    const jobTitleEl = document.createElement("h3");
    jobTitleEl.textContent = title;

    const jobDetailsEl = document.createElement("p");
    jobDetailsEl.textContent = `${company} - ${location}`;

    jobDiv.appendChild(jobTitleEl);
    jobDiv.appendChild(jobDetailsEl);
    
    list.appendChild(jobDiv);

    alert("Job posted successfully!");
}


const menuToggle = document.querySelector('.menu-toggle');
const navLinks = document.querySelector('.nav-links');

menuToggle.addEventListener('click', () => {
  navLinks.classList.toggle('active');
});

function updateCharacterCount(element) {
  const charCountSpan = document.getElementById('charCount');
  const currentLength = element.value.length;
  charCountSpan.textContent = `${currentLength}/5000 characters`;
}
function toggleFields() {
  const checkbox = document.getElementById('defaultCheck1');
  const firstNameInput = document.getElementById('firstname');
  const lastNameInput = document.getElementById('lastname');
  const jobTitleInput = document.getElementById('jobtitle');
  const emailInput = document.getElementById('email');

  if (checkbox.checked) {
      // Disable the input fields
      firstNameInput.disabled = true;
      lastNameInput.disabled = true;
      jobTitleInput.disabled = true;
      emailInput.disabled = true;
  } else {
      // Enable the input fields
      firstNameInput.disabled = false;
      lastNameInput.disabled = false;
      jobTitleInput.disabled = false;
      emailInput.disabled = false;
  }
}

// Automatically hide success and error messages after 1 second
setTimeout(function() {
    var successMessage = document.getElementById("successMessage");
    if (successMessage) {
        successMessage.style.display = "none";
    }
    var errorMessage = document.getElementById("errorMessage");
    if (errorMessage) {
        errorMessage.style.display = "none";
    }
}, 1000);
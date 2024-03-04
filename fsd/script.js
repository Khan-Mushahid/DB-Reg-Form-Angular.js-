document.getElementById('submit-btn').addEventListener('click', function (e) {
  e.preventDefault(); // Prevent default form submission

  // Gather form data
  var formData = new FormData(document.getElementById('user-registration-form'));

  // Send AJAX request
  fetch('register.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json()) // Parse response as JSON
    .then(data => {
      if (data.success) {
        // Show success message
        alert("Registration successful!");
        // Optionally, clear the form or redirect to another page
      } else {
        // Show error message
        alert("Registration failed: " + data.message);
      }
    })
  
});

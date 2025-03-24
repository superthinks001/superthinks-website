document.getElementById("contactForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Prevents default form submission

  let form = event.target;
  let formData = new FormData(form);

  fetch("https://script.google.com/macros/s/AKfycbxY_cyOYZQi-19eK5Y08kkiMbKVKHpraI8xLTpul_PdZcWruF3dCcraK0L-gtfV_yOHfQ/exec", {
      method: "POST",
      body: formData
  })
  .then(response => response.json()) // Expect JSON response
  .then(data => {
      if (data.status === "success") {
          form.reset(); // Clear form fields
          form.style.display = "none"; // Hide the form
          document.getElementById("success-message").style.display = "block"; // Show success message
      } else {
          document.getElementById("error-message").style.display = "block"; // Show error message
      }
  })
  .catch(error => {
      console.error("Error:", error);
      document.getElementById("error-message").style.display = "block"; // Show error message
  });
})
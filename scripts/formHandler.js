document.getElementById("contactForm").addEventListener("submit", function(event) {
  event.preventDefault(); // Prevent default form behavior

  let form = event.target;
  let formData = new FormData(form);

  // Extract field values
  const firstName = form.first_name.value;
  const lastName = form.last_name.value;
  const email = form.email.value;
  const message = form.message.value;

  // 1. Send to Google Apps Script
  let deploymentId = "AKfycbxqJKNMov4eyQ-Ee_QnV_leFhggAfHold8JIkW7gqMW83zsjwz5fFbFGZRuZf0af6uR8g";
  let API = "https://script.google.com/macros/s/" + deploymentId + "/exec";

  fetch(API, {
    method: "POST",
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.status === "success") {
      console.log("Google Sheets updated");
    } else {
      console.error("Google Sheets error:", data);
    }
  })
  .catch(error => {
    console.error("Google Sheets fetch failed:", error);
  });

  // 2. Send email via FormSubmit
  const composedBody = 
    "You have received a new inquiry from:\n\n" +
    "Name: " + firstName + " " + lastName + "\n" +
    "Email: " + email + "\n\n" +
    "Message:\n" + message;

  const formSubmitData = new FormData();
  formSubmitData.append("first_name", firstName);
  formSubmitData.append("last_name", lastName);
  formSubmitData.append("email", email);
  formSubmitData.append("message", message);
  formSubmitData.append("_subject", "New Inquiry Received");
  formSubmitData.append("_body", composedBody);
  formSubmitData.append("_captcha", "false");
  formSubmitData.append("_template", "box");

  fetch("https://formsubmit.co/superthinksai@gmail.com", {
    method: "POST",
    body: formSubmitData
  });

  // 3. Final UI feedback
  form.reset();
  form.style.display = "none";
  document.getElementById("success-message").style.display = "block";
});

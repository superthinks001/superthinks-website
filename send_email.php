<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form fields
    $firstName = htmlspecialchars($_POST['first-name']);
    $lastName = htmlspecialchars($_POST['last-name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    // Your email where the form should be sent
    $to = "superthinksai@gmail.com"; // Replace with the actual target email

    // Email Subject
    $subject = "New Contact Form Submission from $firstName $lastName";

    // Email Body
    $body = "You have received a new message from your website contact form.\n\n".
            "Name: $firstName $lastName\n".
            "Email: $email\n\n".
            "Message:\n$message";

    // Email Headers
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Send Email
    if (mail($to, $subject, $body, $headers)) {
        echo "success"; // AJAX can check this response
    } else {
        echo "error";
    }
} else {
    echo "Invalid Request";
}
?>

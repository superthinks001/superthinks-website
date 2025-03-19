<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST["message"]);

    $to = "contact@superthinks.ai";  // Change this to your actual email
    $subject = "New Contact Form Submission from $first_name $last_name";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "Name: $first_name $last_name\n";
    $body .= "Email: $email\n\n";
    $body .= "Message:\n$message\n";

    // Check if the email is valid before sending
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "invalid_email";
        exit;
    }

    // Attempt to send email
    if (mail($to, $subject, $body, $headers)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = strip_tags(trim($_POST["first_name"]));
    $last_name = strip_tags(trim($_POST["last_name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Validate Input
    if (empty($first_name) || empty($last_name) || empty($email) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please fill in all required fields correctly.";
        exit;
    }

    // Email Content
    $to = "superthinksai@gmail.com"; // 🔹 UPDATE Email ID here
    $subject = "New Contact Form Submission from $first_name $last_name";
    $email_body = "You have received a new message from your contact form.\n\n";
    $email_body .= "Name: $first_name $last_name\n";
    $email_body .= "Email: $email\n\n";
    $email_body .= "Message:\n$message\n";

    // Email Headers
    $headers = "From: $first_name $last_name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send Email
    if (mail($to, $subject, $email_body, $headers)) {
        http_response_code(200);
        echo "Your message has been sent successfully.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong, and we couldn't send your message.";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission. Please try again.";
}
?>

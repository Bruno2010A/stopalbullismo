<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Basic sanitization
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = trim($_POST["message"]);

    // Validate required fields
    if ( empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Please fill in all fields correctly.";
        exit;
    }

    // Recipient email (your email)
    $to = "your.email@example.com";  // <-- change this to your email address

    // Email subject line
    $email_subject = "New Contact Form Submission: $subject";

    // Email content
    $email_body = "You have received a new message from StopAlBullismo.org website contact form.\n\n".
                  "Name: $name\n".
                  "Email: $email\n".
                  "Subject: $subject\n".
                  "Message:\n$message\n";

    // Email headers
    $headers = "From: $name <$email>";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Thank you for contacting us, $name. We will respond as soon as possible.";
    } else {
        echo "Oops! Something went wrong and your message could not be sent.";
    }
} else {
    echo "Invalid request.";
}
?>

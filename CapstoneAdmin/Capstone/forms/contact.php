<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // You can customize the email recipient and content as needed
    $to = 'neilpatrickacierto27@gmail.com';
    $headers = "From: $email";
    $messageBody = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";

    if (mail($to, $subject, $messageBody, $headers)) {
        $_SESSION['message_sent'] = true;
    } else {
        $_SESSION['message_sent'] = false;
        $_SESSION['error_message'] = 'Failed to send the message. Please try again later.';
    }
}
?>

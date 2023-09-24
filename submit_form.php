<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $number = $_POST["number"];
    $email = $_POST["email"];
    $description = $_POST["description"];

    // Set your Gmail email address and app password
    $fromEmail = 'yunuserpak3@gmail.com'; // Your Gmail email
    $fromAppPassword = 'tcwhwilxeepjavgk'; // Your generated app password

    // Retrieve the selected options from the form
    $selectedOptions = [];
    if (isset($_POST["responsive"])) {
        $selectedOptions[] = "Responsive Design (+500kr)";
    }
    if (isset($_POST["domain"])) {
        $selectedOptions[] = "Custom Domain (+100kr - 1000kr / mån)";
    }
    if (isset($_POST["cms"])) {
        $selectedOptions[] = "Lägg ut din hemsida på vår server (+350kr / mån)";
    }

    // If no options are selected, set "None"
    $options = empty($selectedOptions) ? "None" : implode("\n", $selectedOptions);

    // Create a new PHPMailer instance for the main submission
    $mainMail = new PHPMailer(true);
    $confirmationMail = new PHPMailer(true);

    try {
        // Server settings for main submission email
        $mainMail->SMTPDebug = SMTP::DEBUG_OFF; // Set to SMTP::DEBUG_SERVER for debug information
        $mainMail->isSMTP();
        $mainMail->Host = 'smtp.gmail.com';
        $mainMail->SMTPAuth = true;
        $mainMail->Username = $fromEmail;
        $mainMail->Password = $fromAppPassword; // Use the app password here
        $mainMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mainMail->Port = 587;

        // Recipients for main submission email
        $mainMail->setFrom($fromEmail, 'Your Name');
        $mainMail->addAddress('erpakyunus@gmail.com'); // Change to the recipient's email address
        $mainMail->addReplyTo($email, $name);

        // Content for main submission email
        $mainMail->isHTML(false);
        $mainMail->Subject = 'Website Form Submission with Options';
        $mainMail->Body = "Name: $name\nNumber: $number\nEmail: $email\nDescription: $description\n\nSelected Options:\n$options";

        // Send the main submission email
        if (!$mainMail->send()) {
            echo "Form submission failed: {$mainMail->ErrorInfo}";
        }

        // Server settings for confirmation email
        $confirmationMail->SMTPDebug = SMTP::DEBUG_OFF; // Set to SMTP::DEBUG_SERVER for debug information
        $confirmationMail->isSMTP();
        $confirmationMail->Host = 'smtp.gmail.com';
        $confirmationMail->SMTPAuth = true;
        $confirmationMail->Username = $fromEmail;
        $confirmationMail->Password = $fromAppPassword; // Use the app password here
        $confirmationMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $confirmationMail->Port = 587;

        // Recipients for confirmation email
        $confirmationMail->setFrom($fromEmail, 'Your Name');
        $confirmationMail->addAddress($email); // Send to the email provided in the form

        // Content for confirmation email
        $confirmationMail->isHTML(false);
        $confirmationMail->Subject = 'Website Form Submission Confirmation';
        $confirmationMail->Body = "Hello $name,\n\nThank you for submitting the form. Here is a confirmation of your submission:\n\nName: $name\nNumber: $number\nEmail: $email\nDescription: $description\n\nSelected Options:\n$options";

        // Send the confirmation email
        if (!$confirmationMail->send()) {
            echo "Confirmation email failed to send: {$confirmationMail->ErrorInfo}";
        } else {
            header("Location: confirmation.html"); // Redirect to confirmation page
            exit(); // Exit to prevent further execution
        }
    } catch (Exception $e) {
        echo "Form submission failed: {$mainMail->ErrorInfo}";
    }
}
?>

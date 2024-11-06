<?php

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data and sanitize
    $fullName = htmlspecialchars($_POST['fullName']);
    $contactNumber = htmlspecialchars($_POST['contactNumber']);
    $email = htmlspecialchars($_POST['email']);
    $anyMessage = htmlspecialchars($_POST['anyMessage']);

    // Set the recipient email address
    $to = "sunilrana0op@gmail.com";

    // Set the email subject
    $subject = "New  Inquiry";

    // HTML email content with inline CSS for table styling
    $message = '
    <html>
    <head>
      <title>Package Inquiry</title>
      <style>
        body { font-family: "Poppins", sans-serif; color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f2f2f2; }
        footer { margin-top: 20px; font-size: 12px; color: #777; text-align: center; }
      </style>
    </head>
    <body>
      <h2 style="text-align: center; color: #4CAF50;">Package Inquiry</h2>
      <table>
        <tr>
          <th>Field</th>
          <th>Details</th>
        </tr>
        <tr>
          <td>Name</td>
          <td>' . $fullName . '</td>
        </tr>
         <tr>
          <td>Email address</td>
          <td>' . $email . '</td>
        </tr>
        <tr>
          <td>Contact Number</td>
          <td>' . $contactNumber . '</td>
        </tr>
        <tr>
          <td>Message</td>
          <td>' . $anyMessage . '</td>
        </tr>
      </table>

      <footer>
        <p>Inquiry from <a href="https://cobrand.com.np" target="_blank">cobrand.com.np</a></p>
      </footer>
    </body>
    </html>
    ';

    // Set the email headers
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: " . $fullName . " <" . $contactNumber . ">" . "\r\n";

    // Send the email
    if (mail($to, $subject, $message, $headers)) {
        echo json_encode(["status" => "success", "message" => "Email sent successfully!"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error sending email."]);
    }
} else {
    echo "Invalid request.";
}
?>

<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Validate required fields
$required = ['firstName', 'lastName', 'email', 'subject', 'message'];
$errors = [];

foreach ($required as $field) {
    if (empty($data[$field])) {
        $errors[] = ucfirst($field) . ' is required';
    }
}

// Validate email
if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid email address';
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => implode(', ', $errors)]);
    exit;
}

// Sanitize inputs
$firstName = htmlspecialchars(trim($data['firstName']));
$lastName = htmlspecialchars(trim($data['lastName']));
$email = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
$phone = !empty($data['phone']) ? htmlspecialchars(trim($data['phone'])) : 'N/A';
$subject = htmlspecialchars(trim($data['subject']));
$message = htmlspecialchars(trim($data['message']));

// Prepare email
$to = 'support@theartline.com'; // Change this to your email
$emailSubject = 'Contact Form: ' . $subject;
$emailBody = "
New Contact Form Submission

Name: $firstName $lastName
Email: $email
Phone: $phone
Subject: $subject

Message:
$message

---
Sent from The Art Line Contact Form
";

$headers = "From: noreply@theartline.com\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
$mailSent = mail($to, $emailSubject, $emailBody, $headers);

if ($mailSent) {
    // Log to database (optional)
    // You can add database logging here if needed
    
    echo json_encode([
        'success' => true,
        'message' => 'Thank you! Your message has been sent successfully. We\'ll get back to you soon.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to send message. Please try again later.'
    ]);
}
?>

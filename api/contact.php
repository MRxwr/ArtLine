<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'طريقة الطلب غير مسموحة']);
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
        $fieldNames = [
            'firstName' => 'الاسم الأول',
            'lastName' => 'اسم العائلة',
            'email' => 'البريد الإلكتروني',
            'subject' => 'الموضوع',
            'message' => 'الرسالة'
        ];
        $errors[] = $fieldNames[$field] . ' مطلوب';
    }
}

// Validate email
if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'البريد الإلكتروني غير صحيح';
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
$phone = !empty($data['phone']) ? htmlspecialchars(trim($data['phone'])) : 'غير محدد';
$subject = htmlspecialchars(trim($data['subject']));
$message = htmlspecialchars(trim($data['message']));

// Prepare email
$to = 'support@weedesign.com'; // غيري هذا لبريدك الإلكتروني
$emailSubject = 'رسالة من نموذج التواصل: ' . $subject;
$emailBody = "
رسالة جديدة من نموذج التواصل - Wee Design

الاسم: $firstName $lastName
البريد الإلكتروني: $email
رقم الهاتف: $phone
الموضوع: $subject

الرسالة:
$message

---
أرسلت من نموذج التواصل في موقع Wee Design
";

$headers = "From: noreply@weedesign.com\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// Send email
$mailSent = mail($to, $emailSubject, $emailBody, $headers);

if ($mailSent) {
    // Log to database (optional)
    // يمكنك إضافة تسجيل في قاعدة البيانات هنا إذا أردت
    
    echo json_encode([
        'success' => true,
        'message' => 'شكراً لك! تم إرسال رسالتك بنجاح. سنتواصل معك قريباً.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'فشل إرسال الرسالة. يرجى المحاولة مرة أخرى لاحقاً.'
    ]);
}
?>

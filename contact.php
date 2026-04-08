<?php
// =============================================
// AI Sorted — Contact Form Handler
// =============================================
// This runs on your Afrihost cPanel server.
// Place this file in the same directory as index.html.
//
// To use this instead of Formspree/Web3Forms:
// In index.html, change the fetch URL from
//   'https://formspree.io/f/YOUR_FORM_ID'
// to
//   'contact.php'
// =============================================

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: https://aisorted.co.za');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Accept');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// ── CONFIG ──
// Change this to your actual email address
$to_email = 'hello@aisorted.co.za';
$from_email = 'noreply@aisorted.co.za';

// ── HONEYPOT (basic bot protection) ──
if (!empty($_POST['_gotcha'])) {
    // Bot detected — silently accept to not reveal the trap
    echo json_encode(['ok' => true]);
    exit;
}

// ── RATE LIMITING (simple file-based) ──
$ip = $_SERVER['REMOTE_ADDR'];
$rate_file = sys_get_temp_dir() . '/aisorted_rate_' . md5($ip);
if (file_exists($rate_file) && (time() - filemtime($rate_file)) < 60) {
    http_response_code(429);
    echo json_encode(['error' => 'Please wait a minute before submitting again.']);
    exit;
}
touch($rate_file);

// ── SANITISE INPUT ──
$name     = strip_tags(trim($_POST['name'] ?? ''));
$business = strip_tags(trim($_POST['business'] ?? ''));
$email    = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$phone    = strip_tags(trim($_POST['phone'] ?? ''));
$interest = strip_tags(trim($_POST['interest'] ?? ''));
$message  = strip_tags(trim($_POST['message'] ?? ''));

// ── VALIDATE ──
if (empty($name) || empty($email)) {
    http_response_code(400);
    echo json_encode(['error' => 'Name and email are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email address.']);
    exit;
}

// ── FORMAT EMAIL ──
$interest_labels = [
    'ai-receptionist'    => 'AI Receptionist & Lead Capture',
    'content-engine'     => 'Social Media Content Engine',
    'email-followup'     => 'Smart Email & Follow-Up',
    'document-autopilot' => 'Document & Admin Autopilot',
    'reviews-booster'    => 'Google Reviews Booster',
    'booking-calendar'   => 'Smart Booking & Calendar',
    'invoice-autopilot'  => 'Invoice & Expense Autopilot',
    'full-front-office'  => 'The Full Front Office Bundle',
    'training'           => 'AI Training / Workshops',
    'not-sure'           => 'Not sure yet — help me decide',
];

$interest_text = $interest_labels[$interest] ?? $interest;

$subject = "New AI Sorted enquiry from {$name}";
if ($business) $subject .= " ({$business})";

$body = "NEW ENQUIRY FROM AISORTED.CO.ZA\n";
$body .= "================================\n\n";
$body .= "Name:       {$name}\n";
$body .= "Business:   " . ($business ?: 'Not provided') . "\n";
$body .= "Email:      {$email}\n";
$body .= "Phone:      " . ($phone ?: 'Not provided') . "\n";
$body .= "Interested: " . ($interest_text ?: 'Not selected') . "\n";
$body .= "\n--- Message ---\n\n";
$body .= ($message ?: 'No message provided.') . "\n";
$body .= "\n================================\n";
$body .= "Sent: " . date('Y-m-d H:i:s') . " SAST\n";
$body .= "IP:   {$ip}\n";

$headers  = "From: AI Sorted <{$from_email}>\r\n";
$headers .= "Reply-To: {$name} <{$email}>\r\n";
$headers .= "X-Mailer: AISorted-ContactForm/1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

// ── SEND ──
$sent = mail($to_email, $subject, $body, $headers);

if ($sent) {
    echo json_encode(['ok' => true, 'message' => 'Email sent successfully.']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to send email. Please try again or email us directly.']);
}

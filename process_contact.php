<?php
// process_contact.php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.html');
    exit;
}

// Simple sanitization
$name    = trim($_POST['name']);
$email   = trim($_POST['email']);
$subject = trim($_POST['subject']);
$message = trim($_POST['message']);

if (empty($name) || empty($email) || empty($message)) {
    die('Name, email, and message are required.');
}

$stmt = $pdo->prepare("
    INSERT INTO contact (name, email, subject, message)
    VALUES (:name, :email, :subject, :message)
");

$stmt->execute([
    ':name'    => $name,
    ':email'   => $email,
    ':subject' => $subject,
    ':message' => $message,
]);

echo 'Thank you — your message has been received.';
// Alternatively, you can redirect:
// header('Location: thank_you.html');

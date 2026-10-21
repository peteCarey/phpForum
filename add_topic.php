<?php
session_start();

// Use UK local time
date_default_timezone_set('Europe/London');

// Only accept form submissions
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Please submit the form to create a topic.');
}

// Check the CSRF token
$submittedToken = $_POST['csrf_token'] ?? '';
$sessionToken = $_SESSION['csrf_token'] ?? '';

if (
    !is_string($submittedToken) ||
    !is_string($sessionToken) ||
    $sessionToken === '' ||
    !hash_equals($sessionToken, $submittedToken)
) {
    http_response_code(403);
    exit('The form security check failed. Please return to the forum and try again.');
}

// Honeypot check: genuine visitors should leave this field empty
if (trim((string)($_POST['website'] ?? '')) !== '') {
    // Silently reject the submission
    exit('Unable to process your submission.');
}

// Check that the form was displayed and not submitted too quickly
$formTime = $_SESSION['topic_form_time'] ?? 0;

if (!is_numeric($formTime) || time() - (int)$formTime < 3) {
    http_response_code(403);
    exit('Please wait a few seconds and try submitting the form again.');
}

// Get submitted values
$topic  = trim($_POST['topic'] ?? '');
$detail = trim($_POST['detail'] ?? '');
$name   = trim($_POST['name'] ?? '');
$email  = trim($_POST['email'] ?? '');

// Validate required fields
if ($topic === '' || $detail === '' || $name === '' || $email === '') {
    exit('Please complete all required fields.');
}

// Check field lengths
if (
    mb_strlen($topic) > 150 ||
    mb_strlen($detail) > 5000 ||
    mb_strlen($name) > 100 ||
    strlen($email) > 254
) {
    exit('One or more fields are too long.');
}

// Validate email address
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit('Please enter a valid email address.');
}

// Connect to the database
require_once 'database.php';

// Create MySQL-compatible date/time
$datetime = date('Y-m-d H:i:s');

// Insert safely using a prepared statement
$sql = "INSERT INTO forum_question
        (topic, detail, name, email, datetime)
        VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($con, $sql);

if (!$stmt) {
    error_log('Forum prepare error: ' . mysqli_error($con));
    http_response_code(500);
    exit('Sorry, the topic could not be created. Please try again later.');
}

mysqli_stmt_bind_param(
    $stmt,
    'sssss',
    $topic,
    $detail,
    $name,
    $email,
    $datetime
);

if (!mysqli_stmt_execute($stmt)) {
    error_log('Forum insert error: ' . mysqli_stmt_error($stmt));
    http_response_code(500);
    exit('Sorry, the topic could not be created. Please try again later.');
}

mysqli_stmt_close($stmt);
mysqli_close($con);

// Prevent reuse of this form's security token
unset($_SESSION['csrf_token'], $_SESSION['topic_form_time']);

// Redirect to the forum after successful submission
header('Location: main_forum.php');
exit;
?>

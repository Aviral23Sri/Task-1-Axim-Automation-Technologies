<?php
// process_subscription.php
declare(strict_types=1);

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/utils.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?error=' . urlencode('Invalid request method'));
    exit;
}

$name  = sanitize($_POST['name']  ?? '');
$email = strtolower(trim($_POST['email'] ?? ''));
$plan  = trim($_POST['plan'] ?? '');

$errors = [];
if ($name === '' || !validName($name))     $errors[] = 'Please enter a valid name.';
if ($email === '' || !validEmail($email))  $errors[] = 'Please enter a valid email.';
if ($plan === '' || !validPlan($plan))     $errors[] = 'Please select a valid plan.';

if (!empty($errors)) {
    header('Location: index.php?error=' . urlencode(implode(' ', $errors)));
    exit;
}

try {
    $pdo = db();
    $stmt = $pdo->prepare('INSERT INTO subscriptions (name, email, plan) VALUES (:name, :email, :plan)');
    $stmt->execute([
        ':name'  => $name,
        ':email' => $email,
        ':plan'  => $plan,
    ]);

    sendConfirmationEmail($email, $name, $plan);

    header('Location: index.php?success=1');
    exit;
} catch (PDOException $e) {
    $msg = 'Database error.';
    if ((int)$e->getCode() === 23000) {
        $msg = 'This email is already subscribed to the selected plan.';
    }
    header('Location: index.php?error=' . urlencode($msg));
    exit;
}

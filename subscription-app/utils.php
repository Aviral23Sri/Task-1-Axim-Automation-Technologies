<?php
// utils.php
declare(strict_types=1);

function sanitize(string $v): string {
    $v = trim($v);
    $v = filter_var($v, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW);
    return $v;
}

function validName(string $name): bool {
    // Starts with a letter, allows spaces/.'-, length 2..100
    return (bool)preg_match('/^[A-Za-z][A-Za-z\s\'.-]{1,98}$/', $name);
}

function validEmail(string $email): bool {
    return (bool)filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validPlan(string $plan): bool {
    return in_array($plan, ['Basic','Pro','Enterprise'], true);
}

function sendConfirmationEmail(string $to, string $name, string $plan): void {
    $log = __DIR__ . '/email.log';
    $body = sprintf("[%s] TO: %s | SUBJECT: Subscription Confirmation | Hi %s, thanks for subscribing to the %s plan.\n",
        date('c'),
        $to,
        $name,
        $plan
    );
    file_put_contents($log, $body, FILE_APPEND);
}

<?php
// index.php
declare(strict_types=1);
$success = $_GET['success'] ?? null;
$error   = $_GET['error']   ?? null;
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Subscription Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    :root { color-scheme: light dark; }
    body { font-family: system-ui, Arial, sans-serif; background:#f7f7f9; margin:0; padding:24px;}
    .container { max-width: 520px; margin: 0 auto; background:#fff; border:1px solid #e6e6ef; border-radius:12px; padding:24px; box-shadow:0 6px 18px rgba(0,0,0,0.06);}
    h1 { margin-top:0; font-size:22px;}
    label { display:block; margin:12px 0 6px; font-weight:600;}
    input, select { width:100%; padding:10px 12px; border:1px solid #cfd3df; border-radius:8px; font-size:14px; }
    button { margin-top:16px; padding:10px 14px; background:#2563eb; color:#fff; border:none; border-radius:8px; cursor:pointer; }
    .alert { padding:10px 12px; border-radius:8px; margin-bottom:12px; font-size:14px;}
    .alert-success { background:#e7f8ef; color:#176b3a; border:1px solid #b7e4c7;}
    .alert-error { background:#fde8e8; color:#9b1c1c; border:1px solid #f5c2c2;}
    small { color:#6b7280; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Subscribe</h1>
    <?php if ($success): ?>
      <div class="alert alert-success">Subscription saved and confirmation email simulated. Check email.log.</div>
    <?php endif; ?>
    <?php if ($error): ?>
      <div class="alert alert-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div>
    <?php endif; ?>

    <form method="POST" action="process_subscription.php" novalidate>
      <label for="name">Name</label>
      <input id="name" name="name" type="text" maxlength="100" required placeholder="Jane Doe" />

      <label for="email">Email</label>
      <input id="email" name="email" type="email" maxlength="150" required placeholder="jane@example.com" />

      <label for="plan">Subscription Plan</label>
      <select id="plan" name="plan" required>
        <option value="">Select a plan</option>
        <option value="Basic">Basic</option>
        <option value="Pro">Pro</option>
        <option value="Enterprise">Enterprise</option>
      </select>

      <button type="submit">Subscribe</button>
      <div><small>By subscribing, you agree to our terms.</small></div>
    </form>
  </div>
</body>
</html>

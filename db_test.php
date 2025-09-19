<?php
require __DIR__ . '/database.php';
try {
  $pdo = db();
  echo 'OK connected: ' . $pdo->query('SELECT DATABASE()')->fetchColumn();
} catch (Throwable $e) {
  http_response_code(500);
  echo 'Connection failed: ' . $e->getMessage();
}

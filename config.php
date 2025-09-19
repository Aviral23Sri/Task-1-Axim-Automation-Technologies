<?php
// config.php
declare(strict_types=1);

/**
 * Minimal .env loader.
 * Supports KEY=VALUE lines.
 */
function loadEnv(string $path = __DIR__ . '/.env'): void {
    if (!file_exists($path)) return;
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') continue;
        $parts = explode('=', $line, 2);
        if (count($parts) !== 2) continue;
        [$key, $val] = $parts;
        $key = trim($key);
        $val = trim($val);
        $_ENV[$key] = $val;
        putenv("$key=$val");
    }
}

loadEnv();

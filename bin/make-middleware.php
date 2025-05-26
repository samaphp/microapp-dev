#!/usr/bin/env php
<?php

if ($argc < 2) {
    echo "❌ Usage: php make-middleware.php MiddlewareClassName\n";
    echo "   Example: php make-middleware.php SecretPasswordMiddleware\n";
    exit(1);
}

$middlewareClass = preg_replace('/[^a-zA-Z0-9]/', '', $argv[1]);

if (substr($middlewareClass, -10) !== 'Middleware') {
    echo "❌ Middleware name must end with 'Middleware'.\n";
    echo "   Example: php make-middleware.php SecretPasswordMiddleware\n";
    exit(1);
}

$namespace = 'App\\Middleware';
$dir = getcwd() . '/src/Middleware';
$file = "$dir/{$middlewareClass}.php";

if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
    echo "📁 Created directory: $dir\n";
}

if (file_exists($file)) {
    echo "⚠️ Middleware already exists: $file\n";
    exit(0);
}

$template = <<<PHP
<?php
namespace $namespace;

use MicroApp\MicroApp;

class {$middlewareClass}
{
    public function __invoke(MicroApp \$app): void
    {
        \$key = \$app->input('secret');
        if (\$key !== '123') {
            \$app->jsonResponse([
                'error' => ['code' => 401, 'message' => 'Unauthorized']
            ], 401);
        }
    }
}
PHP;

file_put_contents($file, $template);
echo "✅ Created: $file\n";

#!/usr/bin/env php
<?php
require getcwd() . '/vendor/autoload.php';

use MicroApp\MicroApp;

$app = new MicroApp();
$app->loadMiddlewareFrom(getcwd() . '/src/Middleware', 'App\\Middleware');
$app->loadRoutesFrom(getcwd() . '/src/Controller', 'App\\Controller');

$middlewares = $app->getMiddlewares();

// Show registered middleware aliases
if (!empty($middlewares['registry'])) {
    echo "🧱 Middleware Registry:\n\n";
    foreach ($middlewares['registry'] as $name => $class) {
        echo str_pad($name, 20) . $class . "\n";
    }
    echo "\n";
}

// Show global before middlewares if any
if (!empty($middlewares['global_before'])) {
    echo "⚙️  Global Before Middleware:\n\n";
    foreach ($middlewares['global_before'] as $mw) {
        echo "• $mw\n";
    }
    echo "\n";
}

// Show global after middlewares if any
if (!empty($middlewares['global_after'])) {
    echo "⚙️  Global After Middleware:\n\n";
    foreach ($middlewares['global_after'] as $mw) {
        echo "• $mw\n";
    }
    echo "\n";
}

// Show only routes that have before/after middleware
$routes = $middlewares['routes'] ?? [];
$hasShownAnyRoutes = false;

foreach ($routes as $method => $routesByMethod) {
    $filteredRoutes = array_filter($routesByMethod, function ($mwConfig) {
        return !empty($mwConfig['before']) || !empty($mwConfig['after']);
    });

    if (!empty($filteredRoutes)) {
        if (!$hasShownAnyRoutes) {
            echo "🔗 Route-Specific Middleware:\n\n";
            $hasShownAnyRoutes = true;
        }

        echo strtoupper($method) . " routes:\n";
        foreach ($filteredRoutes as $path => $mwConfig) {
            echo "  $path\n";
            if (!empty($mwConfig['before'])) {
                echo "    ↪ before: " . implode(', ', $mwConfig['before']) . "\n";
            }
            if (!empty($mwConfig['after'])) {
                echo "    ↪ after: " . implode(', ', $mwConfig['after']) . "\n";
            }
        }
        echo "\n";
    }
}

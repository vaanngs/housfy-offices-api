<?php

declare(strict_types=1);

use Zend\Stdlib\ArrayUtils;

$settings = require __DIR__ . '/settings/settings_default.php';

if (file_exists(__DIR__ . '/settings/settings_local.php')) {
    $localSettings = require __DIR__ . '/settings/settings_local.php';
    $settings      = ArrayUtils::merge($settings, $localSettings);
}

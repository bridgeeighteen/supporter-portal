<?php

$root = dirname(__DIR__);

$files = [
    // Bootstrap CSS
    "vendor/twbs/bootstrap/dist/css/bootstrap.min.css"     => "public/assets/css/bootstrap.min.css",
    "vendor/twbs/bootstrap/dist/css/bootstrap.min.css.map" => "public/assets/css/bootstrap.min.css.map",
    // Bootstrap JS
    "vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"     => "public/assets/js/bootstrap.bundle.min.js",
    "vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js.map" => "public/assets/js/bootstrap.bundle.min.js.map",
    // Bootstrap Icons CSS
    "vendor/twbs/bootstrap-icons/font/bootstrap-icons.css" => "public/assets/bootstrap-icons/bootstrap-icons.css",
    // Bootstrap Icons fonts
    "vendor/twbs/bootstrap-icons/font/fonts/bootstrap-icons.woff"  => "public/assets/bootstrap-icons/fonts/bootstrap-icons.woff",
    "vendor/twbs/bootstrap-icons/font/fonts/bootstrap-icons.woff2" => "public/assets/bootstrap-icons/fonts/bootstrap-icons.woff2",
];

foreach ($files as $source => $dest) {
    $sourcePath = "$root/$source";
    $destPath   = "$root/$dest";

    if (!file_exists($sourcePath)) {
        echo "  WARNING: Source file not found: $source\n";
        continue;
    }

    $destDir = dirname($destPath);
    if (!is_dir($destDir)) {
        mkdir($destDir, 0755, true);
    }

    copy($sourcePath, $destPath);
    echo "  Copied: $source -> $dest\n";
}

echo "  Assets installed.\n";

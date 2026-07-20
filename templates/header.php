<?php

use BECSP\Config;

$siteName = Config::get('site_name', 'BECSP');
$siteUrl  = Config::siteUrl();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? $siteName, ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="十八桥社区支持者门户">
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/assets/images/logo.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="/" class="site-brand">
                <img src="/assets/images/logo.svg" alt="<?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?>" width="120" height="50">
            </a>
        </div>
    </header>
    <main class="site-main">

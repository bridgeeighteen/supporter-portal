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
    <meta name="description" content="这个门户用于向十八桥社区支持者提供一系列服务。目前只有支持者卡查询服务，但后续会不断完善。">
    <link rel="icon" href="/assets/images/app.jpg" sizes="any">
    <link rel="preconnect" href="https://api.fontshare.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://api.fontshare.com/v2/css?f[]=satoshi@700,500,400&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,700&family=Geist+Mono:wght@400;500&display=swap">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container">
            <a href="/" class="site-brand">
                <img src="/assets/images/logo.svg" alt="<?= htmlspecialchars($siteName, ENT_QUOTES, 'UTF-8') ?>">
            </a>
        </div>
    </header>
    <main class="site-main">

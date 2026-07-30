<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use BECSP\Config;
use BECSP\CardManager;
use BECSP\Validator;
use BECSP\Logger;

$rootPath = dirname(__DIR__);
Config::load($rootPath);

$errorPage = function (string $title, string $message) {
    http_response_code(400);
    $pageTitle = '错误 - ' . Config::get('site_name', 'BECSP');
    ob_start();
    ?>
    <section class="error-section">
        <div class="container">
            <div class="error-card">
                <div class="error-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <h2><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h2>
                <p><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></p>
                <a href="/" class="btn btn-return">
                    <i class="bi bi-arrow-left"></i> 返回首页
                </a>
            </div>
        </div>
    </section>
    <?php
    $content = ob_get_clean();
    require __DIR__ . '/../templates/header.php';
    echo $content;
    require __DIR__ . '/../templates/footer.php';
    exit;
};

// 获取并校验参数
$uidHex = $_GET['uide'] ?? null;
$type   = $_GET['read'] ?? null;
$from   = $_GET['from'] ?? null;

if (!Validator::validateUid($uidHex)) {
    Logger::app()->warning('非法的 UID 参数', ['uid' => $uidHex]);
    $errorPage('参数错误', '提供的 UID 参数无效或格式不正确。');
}
if (!Validator::validateType($type)) {
    Logger::app()->warning('非法的类型参数', ['type' => $type]);
    $errorPage('参数错误', '不支持的卡片类型。');
}
if (!Validator::validateFrom($from)) {
    Logger::app()->warning('非法的来源参数', ['from' => $from]);
    $errorPage('参数错误', '非法的来源参数。');
}

// 用户信息
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
$ipAddress = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

// 记录访问日志
try {
    $cardManager = new CardManager();
    $cardManager->logAccess($uidHex, (int) $type, $from, $userAgent, $ipAddress);
} catch (\Throwable $e) {
    Logger::app()->error('访问日志记录失败: ' . $e->getMessage());
}

// 类型校验（仅允许 02 和 08）
$allowedTypes = Config::get('allowed_card_types', ['02', '08']);
if (!in_array($type, $allowedTypes, true)) {
    Logger::app()->warning('不支持的卡片类型', ['type' => $type]);
    $errorPage('不支持的卡片', '仅支持 NTAG21x 和 T1T 类型的卡片。');
}

// UID 十六进制 -> 十进制转换
$uidHexUpper = strtoupper($uidHex);
if (function_exists('gmp_strval') && function_exists('gmp_init')) {
    $uidDecimal = gmp_strval(gmp_init($uidHexUpper, 16));
} else {
    $uidDecimal = base_convert($uidHexUpper, 16, 10);
}

Logger::app()->info('UID 转换完成', [
    'hex'     => $uidHexUpper,
    'decimal' => $uidDecimal,
    'type'    => $type,
]);

$cardUrl = Config::siteUrl() . '/card.php';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>查询中</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: "PingFang SC", "Microsoft YaHei", system-ui, sans-serif;
            background: oklch(97% 0.008 40);
            color: oklch(16% 0.012 35);
        }
        .redirect-box {
            text-align: center;
            padding: 2rem;
        }
        .spinner {
            width: 40px;
            height: 40px;
            border: 3px solid oklch(82% 0.010 40);
            border-top-color: #ed556a;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin: 0 auto 1rem;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .redirect-box p {
            color: oklch(36% 0.010 35);
            line-height: 1.7;
        }
    </style>
</head>
<body>
<div class="redirect-box">
    <div class="spinner"></div>
    <p>正在查询信息，请稍候...<br>你的 IP 地址已被记录用于审计，十八桥社区不会向任何第三方分享这一信息。</p>
</div>
<form id="autoForm" method="POST" action="<?= htmlspecialchars($cardUrl, ENT_QUOTES, 'UTF-8') ?>">
    <input type="hidden" name="uid_decimal" value="<?= htmlspecialchars($uidDecimal, ENT_QUOTES, 'UTF-8') ?>">
    <input type="hidden" name="type" value="<?= htmlspecialchars($type, ENT_QUOTES, 'UTF-8') ?>">
</form>
<script>
    document.getElementById('autoForm').submit();
</script>
</body>
</html>
<?php
exit;

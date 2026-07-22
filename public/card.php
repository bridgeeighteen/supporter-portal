<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use BECSP\Config;
use BECSP\CardManager;
use BECSP\Validator;
use BECSP\Logger;

$rootPath = dirname(__DIR__);
Config::load($rootPath);

// 错误页面辅助函数
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

// 仅接受 POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // 若非 POST，重定向回首页
    header('Location: /', true, 302);
    exit;
}

// 接收并校验 POST 参数
$uidDecimal = $_POST['uid_decimal'] ?? null;
$type       = $_POST['type'] ?? null;

if (!Validator::validateDecimalUid($uidDecimal)) {
    Logger::app()->warning('非法十进制 UID', ['uid' => $uidDecimal]);
    $errorPage('参数错误', 'UID 参数无效。');
}
if (!Validator::validateType($type)) {
    Logger::app()->warning('非法卡片类型', ['type' => $type]);
    $errorPage('参数错误', '卡片类型参数无效。');
}

// 查询数据库
try {
    $cardManager = new CardManager();
    $card = $cardManager->getCardByUid($uidDecimal, (int) $type);

    $found = ($card !== null);

    $cardTypeLabels = Config::get('card_type_labels', []);
    $typeMismatch = false;
    $registeredTypeLabel = '';

    if (!$found) {
        $cardByUidOnly = $cardManager->getCardByUidOnly($uidDecimal);
        if ($cardByUidOnly !== null) {
            $typeMismatch = true;
            $registeredType = (int) $cardByUidOnly['card_type'];
            $registeredTypeLabel = $cardTypeLabels[$registeredType] ?? '未知';
        }
    }

    $typeLabel = $cardTypeLabels[$type] ?? '未知';
    if ($typeMismatch) {
        $pageTitle = '卡片类型不一致 - ' . Config::get('site_name', 'BECSP');
    } else {
        $pageTitle = $found ? '卡片详情 - ' . Config::get('site_name', 'BECSP') : '未注册 - ' . Config::get('site_name', 'BECSP');
    }

    ob_start();
    require __DIR__ . '/../templates/card.html.php';
    $content = ob_get_clean();

    require __DIR__ . '/../templates/header.php';
    echo $content;
    require __DIR__ . '/../templates/footer.php';

} catch (\Throwable $e) {
    Logger::app()->error('数据库查询异常: ' . $e->getMessage());
    $errorPage('服务异常', '数据库查询出错，请稍后重试。');
}

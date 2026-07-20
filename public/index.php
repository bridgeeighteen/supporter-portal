<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use BECSP\Config;

$rootPath = dirname(__DIR__);
Config::load($rootPath);

$pageTitle = Config::get('site_name', 'BECSP') . ' - 首页';

// 判断浏览器是否支持 Web Serial API——通过前端 JS 设置按钮状态，
// 这里默认按钮为 disabled，JS 检测到支持后启用。
ob_start();
require __DIR__ . '/../templates/index.html.php';
$content = ob_get_clean();

require __DIR__ . '/../templates/header.php';
echo $content;
require __DIR__ . '/../templates/footer.php';
?>
<script src="/assets/js/serial.js"></script>
<script>
(function() {
    if ('serial' in navigator) {
        var btn = document.getElementById('btn-read-card');
        if (btn) {
            btn.disabled = false;
            btn.addEventListener('click', readCard);
        }
    } else {
        var hint = document.getElementById('serial-unsupported');
        if (hint) { hint.classList.remove('d-none'); }
    }
})();
</script>

<?php

use BECSP\Config;

$cardTypeLabels = Config::get('card_type_labels', []);
$typeLabel = $cardTypeLabels[$type ?? '02'] ?? '未知';
$links = Config::get('links', []);
?>
<section class="card-detail-section">
    <div class="container">
        <div class="result-card <?= $found ? 'result-found' : 'result-not-found' ?>">

            <?php if ($found): ?>
                <div class="result-badge result-badge-ok">
                    <i class="bi bi-check-circle-fill"></i> 卡片已验证
                </div>
                <h2 class="result-title">支持者卡信息</h2>
                <div class="result-info">
                    <div class="info-row">
                        <span class="info-label">持卡人</span>
                        <span class="info-value"><?= htmlspecialchars($card['holder_name'], ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">登记卡号</span>
                        <span class="info-value"><?= htmlspecialchars($card['card_number'], ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">证明材料编号</span>
                        <span class="info-value"><?= htmlspecialchars($card['cert_number'] ?? '—', ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">卡类型</span>
                        <span class="info-value"><?= htmlspecialchars($typeLabel, ENT_QUOTES, 'UTF-8') ?></span>
                    </div>
                </div>

            <?php elseif ($typeMismatch): ?>
                <div class="result-badge result-badge-no">
                    <i class="bi bi-exclamation-circle-fill"></i> 卡片有问题
                </div>
                <h2 class="result-title">支持者卡类型不一致</h2>
                <p class="result-desc">
                    传入的卡类型与登记数据不符。<br>
                    每位支持者仅限持有一张支持者卡，使用 UID / CUID 等复制卡卡种复制卡片的行为原则上不被允许。<br>
                    如有特殊情况，请联系社区理事会。
                </p>

            <?php else: ?>
                <div class="result-badge result-badge-no">
                    <i class="bi bi-exclamation-circle-fill"></i> 卡片有问题
                </div>
                <h2 class="result-title">此支持者卡尚未登记</h2>
                <p class="result-desc">
                    系统未找到此支持者卡的注册信息。<br>
                    如需登记，请联系社区理事会。
                </p>
            <?php endif; ?>

            <a href="/" class="btn btn-return">
                <i class="bi bi-arrow-left"></i> 返回首页
            </a>
        </div>

        <div class="links-section mt-5">
            <h2 class="section-title">更多链接</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 mt-3">
                <?php foreach ($links as $link): ?>
                <div class="col">
                    <a href="<?= htmlspecialchars($link['url'], ENT_QUOTES, 'UTF-8') ?>"
                       class="link-card" target="_blank" rel="noopener">
                        <div class="link-icon"><?= htmlspecialchars($link['icon'] ?? '🔗', ENT_QUOTES, 'UTF-8') ?></div>
                        <h4 class="link-title"><?= htmlspecialchars($link['title'], ENT_QUOTES, 'UTF-8') ?></h4>
                        <p class="link-desc"><?= htmlspecialchars($link['desc'], ENT_QUOTES, 'UTF-8') ?></p>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

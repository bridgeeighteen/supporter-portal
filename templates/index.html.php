<?php

use BECSP\Config;

$links = Config::get('links', []);
?>
<section class="hero-section">
    <div class="container">
        <div class="hero-card">
            <h1 class="hero-title">十八桥社区支持者门户</h1>
            <p class="hero-desc">Bridge Eighteen Community Supporter Portal</p>
            <hr class="hero-divider">
            <p class="hero-text">
                本平台用于十八桥社区支持者卡片认证与信息查询。<br>
                请将 NTAG21x 或 T1T 卡片靠近读卡器，然后点击下方按钮。
            </p>
            <button id="btn-read-card" class="btn btn-read-card" disabled>
                <i class="bi bi-nfc"></i> 网页读卡
            </button>
            <p id="serial-unsupported" class="serial-hint d-none">
                您的浏览器不支持 Web Serial API，请使用 Chrome 或 Edge 浏览器。
            </p>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <h2 class="section-title">支持方案</h2>
        <div class="row g-4 mt-3">
            <div class="col-md-6">
                <div class="support-card">
                    <div class="support-icon">❤️</div>
                    <h3>爱发电</h3>
                    <p>通过爱发电平台支持我们的创作与运营，获取专属支持者卡片。</p>
                    <a href="https://afdian.com/@bridge18" class="btn btn-outline-danger btn-sm" target="_blank" rel="noopener">
                        前往支持 <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="support-card">
                    <div class="support-icon">🔗</div>
                    <h3>Matrix Token</h3>
                    <p>加入我们的 Matrix 聊天室，获取去中心化通讯体验与社区令牌。</p>
                    <a href="https://matrix.bridge18.org" class="btn btn-outline-danger btn-sm" target="_blank" rel="noopener">
                        加入 Matrix <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="links-section">
    <div class="container">
        <h2 class="section-title">相关链接</h2>
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
</section>

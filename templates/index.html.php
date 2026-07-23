<?php

use BECSP\Config;

$site_name = Config::get('site_name', []);
?>
<section class="hero-section">
    <div class="container">
        <div class="hero-card">
            <h1 class="hero-title"><?= htmlspecialchars($site_name ?? '十八桥社区支持者门户', ENT_QUOTES, 'UTF-8') ?></h1>
            <hr class="hero-divider">
            <p class="hero-text">
                这个门户用于向十八桥社区支持者提供一系列服务。目前只有支持者卡查询服务，但后续会不断完善。<br>
                使用查询服务时，你的 IP 地址会被记录，以便社区对查询请求进行审计，确保门户的安全。我们不会向任何第三方分享这一信息。<br><br>
                如果你拥有 ATNFC 系列读写器，可将支持者卡放置在读写器上，连接读写器与你的电脑，然后点击下方按钮读取验证。
            </p>
            <button id="btn-read-card" class="btn btn-read-card" disabled>
                <i class="bi bi-nfc"></i> 网页读卡
            </button>
            <p id="serial-unsupported" class="serial-hint d-none">
                这个浏览器不支持 Web Serial API，请在电脑上使用 Chrome / Edge 89 及以上、Firefox 151 及以上和 Opera 75 及以上。有些基于较新版本 Chromium 和 Gecko 内核的浏览器也可能支持。更多详情见 <a href="https://developer.mozilla.org/en-US/docs/Web/API/Web_Serial_API#browser_compatibility" target="_blank" rel="noopener">MDN 文档</a>。<br>拥有 NFC 功能的手机，可以直接打开 NFC 功能，然后按照支持者卡背面的说明操作。 
            </p>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="container">
        <h2 class="section-title">如何支持十八桥社区？</h2>
        <div class="row g-4 mt-3">
            <div class="col-md-6">
                <div class="support-card">
                    <div class="support-icon">❤️</div>
                    <h3>爱发电月付方案</h3>
                    <p>你可以选择预设好的两种不同价位的专项方案，也可以自行设置金额。凡累计捐赠满 10 元即可在社区论坛以及社区在千万桥内外拥有的各种群聊获得支持者称号，满 30 元即可免费获得捐赠证书、支持者卡和预先刷入 Pico OpenPGP 的树莓派 Pico。</p>
                    <a href="https://afdian.com/a/Diamochang" class="btn btn-outline-danger btn-sm" target="_blank" rel="noopener">
                        前往支持 <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="support-card">
                    <div class="support-icon">🔗</div>
                    <h3>购买千万桥附捐注册 Token</h3>
                    <p>千万桥是社区创建、维护的 Matrix 实例，旨在让更多人体验去中心化即时通讯网络的魅力。在公测阶段，购买附捐注册 Token 是在千万桥实例上拥有账号的必选项；正式运营后既可以选择购买附捐 Token，也可以参加入站测试获得免费 Token。</p>
                    <a href="https://afdian.com/item/44f4ce327c7911f1b81c52540025c377" class="btn btn-outline-danger btn-sm" target="_blank" rel="noopener">
                        前往购买（需提前登录爱发电账号） <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


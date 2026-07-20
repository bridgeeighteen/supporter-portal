/**
 * 十八桥社区支持者门户 (BECSP) - Web Serial API 读卡脚本
 *
 * 使用 ATNFC 系列设备的 AT+FIND 命令读取 NTAG21x / T1T 卡片的 UID。
 * 参考：设计方案"JavaScript 读卡核心代码片段"
 */

async function readCard() {
    if (!('serial' in navigator)) {
        showToast('当前浏览器不支持 Web Serial API，请使用 Chrome 或 Edge 浏览器。', 'error');
        return;
    }

    var port;
    var btn = document.getElementById('btn-read-card');

    try {
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>正在连接读卡器...';
        }

        port = await navigator.serial.requestPort();

        await port.open({ baudRate: 115200 });

        if (btn) {
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>正在读取卡片...';
        }

        var writer = port.writable.getWriter();
        var encoder = new TextEncoder();
        await writer.write(encoder.encode('AT+FIND\r\n'));
        writer.releaseLock();

        var reader = port.readable.getReader();
        var result = '';

        while (true) {
            var readResult = await reader.read();
            var value = readResult.value;
            var done = readResult.done;

            if (done) break;

            var chunk = new TextDecoder().decode(value);
            result += chunk;

            if (chunk.includes('\r\nOK\r\n') || chunk.includes('OK\r\n')) {
                break;
            }
        }

        reader.releaseLock();

        try {
            await port.close();
        } catch (e) {
            // 忽略关闭端口错误
        }

        var match = result.match(/\+FIND:([0-9A-F]+),([0-9A-F]{2}),/i);

        if (!match) {
            throw new Error('未能解析卡片数据，请将卡片重新靠近读卡器后重试。');
        }

        var uid = match[1].toUpperCase();
        var typeHex = match[2];
        var type = parseInt(typeHex, 16);
        var typeStr = typeHex.toUpperCase();

        if (![2, 8].includes(type)) {
            showToast('不支持此卡类型（类型代码: 0x' + typeStr + '），请使用 NTAG 或 T1T 卡片。', 'error');
            return;
        }

        if (btn) {
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>正在验证...';
        }

        window.location.href = '/card-rd.php?uide=' + encodeURIComponent(uid) +
                               '&read=' + encodeURIComponent(typeStr) +
                               '&from=web';

    } catch (e) {
        var message = e.message || '未知错误';

        if (message.includes('No port selected') || message.includes('cancelled')) {
            showToast('操作已取消。', 'info');
        } else if (message.includes('Failed to open')) {
            showToast('无法打开串口设备，请检查读卡器连接。', 'error');
        } else {
            showToast('读卡失败：' + message, 'error');
        }

        console.error('[BECSP] 读卡异常:', e);

        try {
            if (port) { await port.close(); }
        } catch (e2) {
            // 忽略
        }
    } finally {
        if (btn) {
            btn.disabled = false;
            btn.innerHTML = '<i class="bi bi-nfc"></i> 网页读卡';
        }
    }
}

// 简易 toast 提示
function showToast(message, type) {
    type = type || 'info';

    var bgColor = type === 'error' ? '#ed556a' : type === 'info' ? '#6c757d' : '#a70034';

    var toast = document.createElement('div');
    toast.style.cssText = [
        'position: fixed',
        'top: 20px',
        'left: 50%',
        'transform: translateX(-50%)',
        'background: ' + bgColor,
        'color: #fff',
        'padding: 0.75rem 1.5rem',
        'border-radius: 2rem',
        'font-size: 0.9rem',
        'font-weight: 500',
        'z-index: 9999',
        'box-shadow: 0 4px 20px rgba(0,0,0,0.2)',
        'opacity: 0',
        'transition: opacity 0.3s ease',
        'pointer-events: none',
        'max-width: 90vw',
        'text-align: center'
    ].join(';');
    toast.textContent = message;
    document.body.appendChild(toast);

    requestAnimationFrame(function() {
        toast.style.opacity = '1';
    });

    setTimeout(function() {
        toast.style.opacity = '0';
        setTimeout(function() {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }, 3500);
}

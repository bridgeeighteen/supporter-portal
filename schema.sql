-- ============================================================
-- 十八桥社区支持者门户 (BECSP) - 数据库初始化脚本
-- 支持 MySQL 5.7+ / MariaDB 10.3+
-- ============================================================

-- 卡片主表
CREATE TABLE IF NOT EXISTS `cards` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `uid_decimal` VARCHAR(20) NOT NULL COMMENT '十进制 UID（转码后）',
    `card_type` TINYINT UNSIGNED NOT NULL COMMENT '卡类型编号（2=NTAG21x, 8=T1T）',
    `card_number` VARCHAR(20) NOT NULL COMMENT '登记卡号',
    `cert_number` VARCHAR(50) DEFAULT NULL COMMENT '证书编号',
    `holder_name` VARCHAR(100) NOT NULL COMMENT '持卡人姓名',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY `uk_uid_type` (`uid_decimal`, `card_type`),
    INDEX `idx_uid_type` (`uid_decimal`, `card_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 访问日志表
CREATE TABLE IF NOT EXISTS `access_logs` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `uid_hex` VARCHAR(50) NOT NULL COMMENT '原始十六进制 UID',
    `card_type` TINYINT UNSIGNED NOT NULL,
    `from_source` ENUM('inside', 'web') NOT NULL,
    `user_agent` VARCHAR(255) NOT NULL,
    `ip_address` VARCHAR(45) NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_uid_time` (`uid_hex`, `created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 插入测试数据（示例卡片，UID 为占位）
-- INSERT INTO `cards` (`uid_decimal`, `card_type`, `card_number`, `cert_number`, `holder_name`) VALUES
-- ('1234567890', 2, 'BCSC0001', 'BCD-00001/A', '张三'),
-- ('9876543210', 8, 'BCSC0002', 'BCD-00002/A', '李四');

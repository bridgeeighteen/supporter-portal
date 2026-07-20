<?php

namespace BECSP;

class CardManager
{
    private \Medoo\Medoo $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getCardByUid(string $uidDecimal, int $type): ?array
    {
        $result = $this->db->get('cards', '*', [
            'uid_decimal' => $uidDecimal,
            'card_type'   => $type,
        ]);

        return $result ?: null;
    }

    public function logAccess(string $uidHex, int $type, string $from, string $ua, string $ip): void
    {
        try {
            $this->db->insert('access_logs', [
                'uid_hex'    => $uidHex,
                'card_type'  => $type,
                'from_source' => $from,
                'user_agent' => $ua,
                'ip_address' => $ip,
            ]);
        } catch (\Throwable $e) {
            Logger::app()->error('记录访问日志失败', [
                'error'   => $e->getMessage(),
                'uid_hex' => $uidHex,
                'type'    => $type,
            ]);
        }

        Logger::access()->info('卡片访问', [
            'uid_hex'     => $uidHex,
            'card_type'   => $type,
            'from_source' => $from,
            'ip'          => $ip,
            'ua'          => $ua,
        ]);
    }

    public function cardExists(string $uidDecimal, int $type): bool
    {
        return $this->db->has('cards', [
            'uid_decimal' => $uidDecimal,
            'card_type'   => $type,
        ]);
    }
}

<?php

namespace BECSP;

class Validator
{
    public static function validateUid(?string $uidHex): bool
    {
        if ($uidHex === null || $uidHex === '') {
            return false;
        }

        $len = strlen($uidHex);
        if ($len < 8 || $len > 20) {
            return false;
        }

        return (bool) preg_match('/^[0-9A-Fa-f]+$/', $uidHex);
    }

    public static function validateType(?string $type): bool
    {
        if ($type === null || $type === '') {
            return false;
        }

        $allowed = Config::get('allowed_card_types', ['02', '08']);

        return in_array($type, $allowed, true);
    }

    public static function validateFrom(?string $from): bool
    {
        if ($from === null || $from === '') {
            return false;
        }

        return in_array($from, ['inside', 'web'], true);
    }

    public static function validateDecimalUid(?string $decimal): bool
    {
        if ($decimal === null || $decimal === '') {
            return false;
        }

        return (bool) preg_match('/^\d+$/', $decimal);
    }

    public static function sanitizeString(?string $value): string
    {
        return $value !== null ? htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8') : '';
    }
}

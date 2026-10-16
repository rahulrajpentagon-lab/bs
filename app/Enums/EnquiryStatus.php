<?php

namespace App\Enums;

enum EnquiryStatus: string
{
    case New = 'new';
    case Contacted = 'contacted';
    case InProgress = 'in_progress';
    case Completed = 'completed';
    case Rejected = 'rejected';
    case Cancelled = 'cancelled';

    public function label(): string
    {
        return match ($this) {
            self::New => 'New',
            self::Contacted => 'Contacted',
            self::InProgress => 'In Progress',
            self::Completed => 'Completed',
            self::Rejected => 'Rejected',
            self::Cancelled => 'Cancelled',
        };
    }

    public function badgeClass(): string
    {
        return match ($this) {
            self::New => 'bg-primary',
            self::Contacted => 'bg-info text-dark',
            self::InProgress => 'bg-warning text-dark',
            self::Completed => 'bg-success',
            self::Rejected => 'bg-danger',
            self::Cancelled => 'bg-secondary',
        };
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $status) {
            $options[$status->value] = $status->label();
        }

        return $options;
    }
}

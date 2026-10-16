<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationEmail extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'email',
        'label',
        'is_active',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    /**
     * @return list<string>
     */
    public static function activeAddresses(): array
    {
        $emails = static::query()
            ->active()
            ->orderBy('email')
            ->pluck('email')
            ->filter()
            ->unique()
            ->values()
            ->all();

        if ($emails !== []) {
            return $emails;
        }

        $fallback = config('mail.admin_email');

        return filled($fallback) ? [$fallback] : [];
    }
}

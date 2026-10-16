<?php

namespace App\Models;

use App\Enums\EnquiryStatus;
use Database\Factories\EnquiryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    /** @use HasFactory<EnquiryFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'subject',
        'service',
        'message',
        'status',
        'admin_notes',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => EnquiryStatus::class,
        ];
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if (blank($search)) {
            return $query;
        }

        $term = '%'.str_replace(['%', '_'], ['\\%', '\\_'], $search).'%';

        return $query->where(function (Builder $builder) use ($term) {
            $builder->where('name', 'like', $term)
                ->orWhere('email', 'like', $term)
                ->orWhere('phone', 'like', $term)
                ->orWhere('subject', 'like', $term)
                ->orWhere('company', 'like', $term)
                ->orWhere('message', 'like', $term)
                ->orWhere('service', 'like', $term);
        });
    }

    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        if (blank($status) || $status === 'all') {
            return $query;
        }

        return $query->where('status', $status);
    }

    public function scopeSubmittedBetween(Builder $query, ?string $from, ?string $to): Builder
    {
        if (filled($from)) {
            $query->whereDate('created_at', '>=', $from);
        }

        if (filled($to)) {
            $query->whereDate('created_at', '<=', $to);
        }

        return $query;
    }
}

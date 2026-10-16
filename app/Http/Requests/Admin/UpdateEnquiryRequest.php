<?php

namespace App\Http\Requests\Admin;

use App\Enums\EnquiryStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEnquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::enum(EnquiryStatus::class)],
            'admin_notes' => ['nullable', 'string', 'max:10000'],
        ];
    }
}

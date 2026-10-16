<?php

namespace Database\Seeders;

use App\Models\NotificationEmail;
use Illuminate\Database\Seeder;

class NotificationEmailSeeder extends Seeder
{
    public function run(): void
    {
        $emails = array_filter([
            env('ADMIN_EMAIL'),
            'rahul2018amr@gmail.com',
        ]);

        foreach (array_unique($emails) as $email) {
            NotificationEmail::query()->updateOrCreate(
                ['email' => strtolower($email)],
                [
                    'label' => 'Primary admin',
                    'is_active' => true,
                ]
            );
        }
    }
}

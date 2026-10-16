<?php

namespace Database\Seeders;

use App\Enums\EnquiryStatus;
use App\Models\Enquiry;
use Illuminate\Database\Seeder;

class EnquirySeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            [
                'name' => 'Anjali Nair',
                'email' => 'anjali@example.com',
                'phone' => '+91 98765 11111',
                'company' => 'Green Leaf Cafe',
                'service' => 'Business Website',
                'message' => 'We need a modern website for our cafe with menu and WhatsApp ordering.',
                'status' => EnquiryStatus::New,
            ],
            [
                'name' => 'Rahul Menon',
                'email' => 'rahul@example.com',
                'phone' => '+91 98765 22222',
                'company' => 'TechServe Solutions',
                'service' => 'Web Application',
                'message' => 'Looking for a CRM-style dashboard for our sales team.',
                'status' => EnquiryStatus::Contacted,
            ],
            [
                'name' => 'Meera Krishnan',
                'email' => 'meera@example.com',
                'phone' => null,
                'company' => 'Bloom Boutique',
                'service' => 'E-commerce Application',
                'message' => 'Need an online store for clothing with payment gateway support.',
                'status' => EnquiryStatus::InProgress,
            ],
            [
                'name' => 'Vivek Suresh',
                'email' => 'vivek@example.com',
                'phone' => '+91 98765 33333',
                'company' => 'FitZone Gym',
                'service' => 'Mobile App',
                'message' => 'We want a membership booking app for our gym clients.',
                'status' => EnquiryStatus::Completed,
            ],
            [
                'name' => 'Sara Thomas',
                'email' => 'sara@example.com',
                'phone' => '+91 98765 44444',
                'company' => 'Coastal Tours',
                'service' => 'SEO',
                'message' => 'Need SEO help for our tourism website in Kerala.',
                'status' => EnquiryStatus::Rejected,
            ],
        ];

        foreach ($samples as $sample) {
            Enquiry::query()->create($sample);
        }
    }
}

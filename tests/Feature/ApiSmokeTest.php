<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiSmokeTest extends TestCase
{
    use RefreshDatabase;

    public function test_company_endpoint_returns_json(): void
    {
        $this->getJson('/api/company')
            ->assertOk()
            ->assertJsonStructure(['name', 'phone', 'email', 'whatsapp', 'location']);
    }

    public function test_works_endpoint_returns_featured_and_all(): void
    {
        $this->getJson('/api/works')
            ->assertOk()
            ->assertJsonStructure(['featured', 'all']);
    }

    public function test_enquiry_can_be_submitted(): void
    {
        $this->postJson('/api/enquiries', [
            'company' => 'Test Biz',
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'message' => 'Need a business website.',
            'website' => '',
        ])
            ->assertCreated()
            ->assertJsonStructure(['message', 'enquiry_id']);

        $this->assertDatabaseHas('enquiries', [
            'email' => 'jane@example.com',
            'company' => 'Test Biz',
        ]);
    }
}

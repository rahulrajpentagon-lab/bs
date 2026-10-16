<?php

namespace Tests\Feature;

use App\Enums\EnquiryStatus;
use App\Mail\EnquiryConfirmationMail;
use App\Mail\NewEnquiryMail;
use App\Models\Enquiry;
use App\Models\NotificationEmail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use RefreshDatabase;

    public function test_root_redirects_to_frontend(): void
    {
        $this->get('/')
            ->assertRedirect(config('app.frontend_url'));
    }

    public function test_enquiry_validation_works(): void
    {
        $this->postJson('/api/enquiries', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'company', 'message']);
    }

    public function test_valid_enquiry_is_stored_and_emails_are_sent(): void
    {
        Mail::fake();

        NotificationEmail::query()->create([
            'email' => 'admin@kayacode.com',
            'label' => 'Primary',
            'is_active' => true,
        ]);

        NotificationEmail::query()->create([
            'email' => 'sales@kayacode.com',
            'label' => 'Sales',
            'is_active' => true,
        ]);

        $payload = [
            'name' => 'Test User',
            'email' => 'customer@example.com',
            'phone' => '+91 98765 43210',
            'company' => 'Test Business',
            'service' => 'Business Website',
            'message' => 'We need a new website for our business.',
            'website' => '',
        ];

        $this->postJson('/api/enquiries', $payload)
            ->assertCreated()
            ->assertJsonStructure(['message', 'enquiry_id']);

        $this->assertDatabaseHas('enquiries', [
            'email' => 'customer@example.com',
            'company' => 'Test Business',
            'status' => EnquiryStatus::New->value,
        ]);

        Mail::assertSent(NewEnquiryMail::class, 2);
        Mail::assertSent(EnquiryConfirmationMail::class, function (EnquiryConfirmationMail $mail) {
            return $mail->hasTo('customer@example.com');
        });
    }

    public function test_enquiry_is_kept_when_email_fails(): void
    {
        $pending = \Mockery::mock();
        $pending->shouldReceive('send')->andThrow(new \RuntimeException('SMTP down'));

        Mail::shouldReceive('to')->andReturn($pending);

        $this->postJson('/api/enquiries', [
            'name' => 'Resilient User',
            'email' => 'resilient@example.com',
            'company' => 'Resilient Co',
            'message' => 'Please keep my enquiry even if mail fails.',
            'website' => '',
        ])->assertCreated();

        $this->assertDatabaseHas('enquiries', [
            'email' => 'resilient@example.com',
        ]);
    }

    public function test_admin_login_works(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@kayacode.com',
            'password' => 'password',
            'role' => User::ROLE_ADMIN,
        ]);

        $this->postJson('/api/admin/login', [
            'email' => $admin->email,
            'password' => 'password',
        ])->assertOk()->assertJsonPath('user.email', $admin->email);

        $this->assertAuthenticatedAs($admin);
    }

    public function test_unauthenticated_users_cannot_access_admin_api(): void
    {
        $this->getJson('/api/admin/dashboard')
            ->assertUnauthorized();
    }

    public function test_non_admin_cannot_access_admin_api(): void
    {
        $user = User::factory()->create(['role' => 'customer']);

        $this->actingAs($user)
            ->getJson('/api/admin/dashboard')
            ->assertForbidden();
    }

    public function test_admin_can_view_enquiries(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        Enquiry::factory()->create(['name' => 'Visible Enquiry']);

        $this->actingAs($admin)
            ->getJson('/api/admin/enquiries')
            ->assertOk()
            ->assertJsonFragment(['name' => 'Visible Enquiry']);
    }

    public function test_admin_can_update_enquiry_status_and_notes(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $enquiry = Enquiry::factory()->create();

        $this->actingAs($admin)
            ->putJson('/api/admin/enquiries/'.$enquiry->id, [
                'status' => EnquiryStatus::InProgress->value,
                'admin_notes' => 'Called the customer.',
            ])
            ->assertOk()
            ->assertJsonPath('enquiry.status', EnquiryStatus::InProgress->value);

        $enquiry->refresh();

        $this->assertSame(EnquiryStatus::InProgress, $enquiry->status);
        $this->assertSame('Called the customer.', $enquiry->admin_notes);
    }

    public function test_admin_can_search_enquiries(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        Enquiry::factory()->create(['name' => 'John Doe', 'email' => 'john@example.com']);
        Enquiry::factory()->create(['name' => 'Jane Smith', 'email' => 'jane@example.com']);

        $this->actingAs($admin)
            ->getJson('/api/admin/enquiries?search=john')
            ->assertOk()
            ->assertJsonFragment(['name' => 'John Doe'])
            ->assertJsonMissing(['name' => 'Jane Smith']);
    }

    public function test_admin_can_manage_notification_emails(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $this->actingAs($admin)
            ->postJson('/api/admin/notification-emails', [
                'email' => 'team@example.com',
                'label' => 'Team inbox',
            ])
            ->assertCreated();

        $this->assertDatabaseHas('notification_emails', [
            'email' => 'team@example.com',
            'is_active' => true,
        ]);
    }

    public function test_admin_can_delete_enquiries(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $enquiry = Enquiry::factory()->create();

        $this->actingAs($admin)
            ->deleteJson('/api/admin/enquiries/'.$enquiry->id)
            ->assertOk();

        $this->assertDatabaseMissing('enquiries', ['id' => $enquiry->id]);
    }
}

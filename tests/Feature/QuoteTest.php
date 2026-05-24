<?php

namespace Tests\Feature;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuoteTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
        $this->admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password123',
        ]);
    }

    public function test_anyone_can_view_quotes_list(): void
    {
        Quote::create([
            'quote_text' => 'Lorem ipsum dolor sit amet.',
            'author' => 'John Doe',
        ]);

        $response = $this->get('/quotes');

        $response->assertStatus(200);
        $response->assertSee('Lorem ipsum dolor sit amet.');
    }

    public function test_admin_can_create_new_quote(): void
    {
        $response = $this->actingAs($this->admin)->post('/quotes', [
            'quote_text' => 'To be or not to be.',
            'author' => 'William S.',
        ]);

        $response->assertRedirect('/quotes');

        $this->assertDatabaseHas('quotes', [
            'quote_text' => 'To be or not to be.',
            'author' => 'William S.',
        ]);
    }

    public function test_admin_can_update_quote(): void
    {
        $quote = Quote::create([
            'quote_text' => 'Old quote text.',
            'author' => 'Old Author',
        ]);

        $response = $this->actingAs($this->admin)->put("/quotes/{$quote->id}", [
            'quote_text' => 'Updated quote text.',
            'author' => 'New Author',
        ]);

        $response->assertRedirect('/quotes');

        $this->assertDatabaseHas('quotes', [
            'id' => $quote->id,
            'quote_text' => 'Updated quote text.',
        ]);
    }

    public function test_admin_can_delete_quote(): void
    {
        $quote = Quote::create([
            'quote_text' => 'This quote will be deleted.',
            'author' => 'Jane Doe',
        ]);

        $response = $this->actingAs($this->admin)->delete(
            "/quotes/{$quote->id}",
        );

        $response->assertRedirect('/quotes');

        $this->assertDatabaseMissing('quotes', [
            'id' => $quote->id,
        ]);
    }

    public function test_guest_cannot_create_quote(): void
    {
        $response = $this->post('/quotes', [
            'quote_text' => 'Hack attempt.',
            'author' => 'Hacker',
        ]);

        $response->assertRedirect('/login');

        $this->assertDatabaseMissing('quotes', [
            'quote_text' => 'Hack attempt.',
        ]);
    }
}

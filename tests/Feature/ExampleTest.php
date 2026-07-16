<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_homepage_and_auth_pages_render(): void
    {
        $this->get('/')->assertOk()->assertSee('GameNova');
        $this->get('/login')->assertOk()->assertSee('Welcome back');
        $this->get('/register')->assertOk()->assertSee('Create account');
    }

    public function test_each_game_page_renders_from_configuration(): void
    {
        $games = [
            'free-fire' => 'Free Fire Diamonds',
            'pubg-mobile' => 'PUBG Mobile UC',
            'mobile-legends' => 'Mobile Legends Diamonds',
            'call-of-duty' => 'Call of Duty CP',
            'valorant' => 'Valorant Points',
        ];

        foreach ($games as $slug => $title) {
            $this->get("/games/{$slug}")
                ->assertOk()
                ->assertSee($title)
                ->assertSee('Select Recharge');
        }

        $this->get('/games/not-a-game')->assertNotFound();
    }

    public function test_a_valid_wallet_order_can_be_submitted(): void
    {
        $this->post('/games/pubg-mobile/orders', [
            'player_id' => '123456789',
            'package' => '60 UC',
            'payment' => 'wallet',
        ])->assertSessionHasNoErrors()->assertSessionHas('order_success');

        $this->assertDatabaseHas('orders', [
            'game_slug' => 'pubg-mobile',
            'package_name' => '60 UC',
            'amount' => 95,
            'player_id' => '123456789',
            'payment_method' => 'wallet',
            'status' => 'pending',
        ]);
    }

    public function test_admin_dashboard_is_protected_and_admin_can_manage_orders(): void
    {
        $customer = User::factory()->create();
        $admin = User::factory()->create(['is_admin' => true]);
        $order = Order::query()->create([
            'reference' => 'GN-TEST-001',
            'game_slug' => 'free-fire',
            'game_name' => 'Free Fire',
            'package_name' => '115 Diamonds',
            'amount' => 85,
            'player_id' => '123456789',
            'payment_method' => 'bkash',
            'payer_number' => '01700000000',
            'transaction_id' => 'ABC12345',
            'status' => 'pending',
        ]);

        $this->get('/admin')->assertRedirect('/login');
        $this->actingAs($customer)->get('/admin')->assertForbidden();

        $this->actingAs($admin)
            ->get('/admin')
            ->assertOk()
            ->assertSee('Dashboard overview')
            ->assertSee('GN-TEST-001');

        $this->actingAs($admin)
            ->patch("/admin/orders/{$order->id}", [
                'status' => 'completed',
                'admin_note' => 'Top-up delivered.',
            ])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'completed',
            'admin_note' => 'Top-up delivered.',
        ]);
    }

    public function test_all_storefront_images_exist_and_are_rendered(): void
    {
        $this->assertFileExists(public_path('assets/gaming-hero.png'));

        foreach (config('games') as $slug => $game) {
            $this->assertFileExists(public_path($game['image']));

            $this->get("/games/{$slug}")
                ->assertOk()
                ->assertSee(asset($game['image']));
        }

        $authCss = file_get_contents(public_path('css/auth.css'));
        $this->assertStringContainsString('../assets/gaming-hero.png', $authCss);
    }
}

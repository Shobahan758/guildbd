<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
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

    public function test_registration_login_logout_and_guest_redirects_work(): void
    {
        $this->post('/register', [
            'first_name' => 'Nova',
            'last_name' => 'Player',
            'email' => 'player@example.com',
            'phone' => '01712345678',
            'password' => 'StrongPass123!',
            'password_confirmation' => 'StrongPass123!',
            'terms' => '1',
        ])->assertRedirect('/');

        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'player@example.com',
            'phone' => '01712345678',
        ]);
        $this->get('/login')->assertRedirect('/');
        $this->post('/logout')->assertRedirect('/');
        $this->assertGuest();

        $this->post('/login', [
            'email' => 'player@example.com',
            'password' => 'StrongPass123!',
        ])->assertRedirect('/');
        $this->assertAuthenticated();
    }

    public function test_a_user_can_reset_their_password(): void
    {
        Notification::fake();
        $user = User::factory()->create(['email' => 'reset@example.com']);

        $this->post('/forgot-password', ['email' => $user->email])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status');

        $token = null;
        Notification::assertSentTo($user, ResetPassword::class, function (ResetPassword $notification) use (&$token) {
            $token = $notification->token;

            return true;
        });

        $this->post('/reset-password', [
            'token' => $token,
            'email' => $user->email,
            'password' => 'NewStrongPass123!',
            'password_confirmation' => 'NewStrongPass123!',
        ])->assertRedirect('/login')->assertSessionHasNoErrors();

        $this->assertTrue(Hash::check('NewStrongPass123!', $user->fresh()->password));
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

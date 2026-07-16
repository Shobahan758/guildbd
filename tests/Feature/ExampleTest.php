<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
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

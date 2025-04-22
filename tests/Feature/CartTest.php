<?php

namespace Tests\Feature;

use App\Models\Computer;
use App\Models\Component;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_computer_to_cart(): void
    {
        $user = User::factory()->create();
        $computer = Computer::factory()->create();

        $this->actingAs($user)
            ->post(route('cart.store'), ['computer' => $computer->id])
            ->assertRedirect()
            ->assertSessionHas('success', 'Товар успешно добавлен в корзину');

        $this->assertDatabaseHas('cart_items', [
            'computer_id' => $computer->id,
            'quantity' => 1,
        ]);
    }

    public function test_existing_cart_item_quantity_is_incremented(): void
    {
        $user = User::factory()->create();
        $computer = Computer::factory()->create();

        $cart = \App\Models\Cart::factory()->create(['user_id' => $user->id]);

        \App\Models\CartItem::create([
            'cart_id' => $cart->id,
            'computer_id' => $computer->id,
            'quantity' => 1,
        ]);

        $this->actingAs($user)
            ->post(route('cart.store'), ['computer' => $computer->id])
            ->assertRedirect()
            ->assertSessionHas('success', 'Товар успешно добавлен в корзину');

        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $cart->id,
            'computer_id' => $computer->id,
            'quantity' => 2,
        ]);
    }
}

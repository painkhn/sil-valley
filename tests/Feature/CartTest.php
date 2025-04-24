<?php

namespace Tests\Feature;

use App\Models\{User, Cart, CartItem, Computer, Component};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    /*
    * Тест успешного добавления в корзину
    */
    public function test_user_can_add_computer_to_cart(): void
    {
        // Создаём пользователя и компьютер
        $user = User::factory()->create();
        $computer = Computer::factory()->create();

        // От имени пользователя отправляет POST запрос для добавления в корзину
        $this->actingAs($user)
            ->post(route('cart.store'), ['computer' => $computer->id])
            ->assertRedirect()
            ->assertSessionHas('success', 'Товар успешно добавлен в корзину');

        // Проверяем, что в бд появилась запись
        $this->assertDatabaseHas('cart_items', [
            'computer_id' => $computer->id,
            'quantity' => 1,
        ]);
    }

    /*
    * Тест успешного увеличения кол-ва товара в корзине
    */
    public function test_existing_cart_item_quantity_is_incremented(): void
    {
        // Создаём пользователя и компьютер
        $user = User::factory()->create();
        $computer = Computer::factory()->create();

        // Создаём корзину для пользователя
        $cart = Cart::factory()->create(['user_id' => $user->id]);

        // Добавляем товар в корзину с количеством 1
        CartItem::create([
            'cart_id' => $cart->id,
            'computer_id' => $computer->id,
            'quantity' => 1,
        ]);

        // Отправляем запрос на добавление этого же товара снова
        $this->actingAs($user)
            ->post(route('cart.store'), ['computer' => $computer->id])
            ->assertRedirect()
            ->assertSessionHas('success', 'Товар успешно добавлен в корзину');

        // Проверяем, что количество товара обновилось до 2
        $this->assertDatabaseHas('cart_items', [
            'cart_id' => $cart->id,
            'computer_id' => $computer->id,
            'quantity' => 2,
        ]);
    }
}

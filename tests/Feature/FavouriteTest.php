<?php

namespace Tests\Feature;

use App\Models\{User, Computer, Component};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FavouriteTest extends TestCase
{
    use RefreshDatabase;

    /*
    * Тест проверки добавления компьютера в избранное
    */
    public function test_user_can_add_computer_to_favorites(): void
    {
        // Создаём пользователя и компьютер
        $user = User::factory()->create();
        $computer = Computer::factory()->create();

        // Отправляем POST-запрос на добавление в избранное
        $response = $this->actingAs($user)->post(route('favorites.store', $computer));

        // Проверяем редирект и сообщение об успехе
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Товар добавлен в избранное');

        // Проверка, что запись добавлена в таблицу избранного
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'computer_id' => $computer->id,
        ]);
    }

    /*
    * Тест удаления компюютера из избранного
    */
    public function test_user_can_remove_computer_from_favorites(): void
    {
        // Создаём пользователя и добавляем компьютер в избранное
        $user = User::factory()->create();
        $computer = Computer::factory()->create();
        $user->favorites()->create(['computer_id' => $computer->id]);

        // Отправляем POST-запрос
        $response = $this->actingAs($user)->post(route('favorites.store', $computer));

        // Проверяем редирект и сообщение об удалении
        $response->assertRedirect();
        $response->assertSessionHas('success', 'Товар удалён из избранного');

        // Проверка, что запись удалена из таблицы избранного
        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'computer_id' => $computer->id,
        ]);
    }

    /*
    * Тест, что неавторизованный пользователь не может добавить в избранное
    */
    public function test_guest_cannot_toggle_favorites(): void
    {
        // Создаём компьютер
        $computer = Computer::factory()->create();

        // Пробуем отправить POST-запрос без авторизации
        $response = $this->post(route('favorites.store', $computer));

        // Проверка редиректа на страницу входа
        $response->assertRedirect(route('login'));

        // Проверка, что ничего не записано в бд
        $this->assertDatabaseMissing('favorites', [
            'computer_id' => $computer->id,
        ]);
    }

    /*
    * Тест ошибки добавления в избранное несуществующего компьютера
    */
    public function test_user_cannot_favorite_nonexistent_computer(): void
    {
        // Создаём пользователя
        $user = User::factory()->create();

        // Пробуем добавить компьютер с несуществующим ID
        $response = $this->actingAs($user)->post(route('favorites.store', ['computer' => 99999]));

        // Ожидаем ошибку 404
        $response->assertNotFound();

        // Проверка, что в избранном нет такой записи
        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'computer_id' => 99999,
        ]);
    }
}

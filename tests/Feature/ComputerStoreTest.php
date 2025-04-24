<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ComputerStoreTest extends TestCase
{
    use RefreshDatabase;

    /*
    * Тест на добавление компьютера
    */
    public function test_admin_can_add_computer(): void
    {
        // Хранилище для создания изображения
        Storage::fake('public');

        // Создаём администратора
        $admin = User::factory()->admin()->create();

        // Подготовка данных и компонентов
        $data = [
            'name' => 'Test PC',
            'description' => 'Some cool gaming PC',
            'price' => 2999.99,
            'image' => UploadedFile::fake()->image('pc.jpg'),

            'components' => [
                'cpu' => [
                    'name' => 'Ryzen 5 5600X',
                    'cores' => 6,
                    'threads' => 12,
                    'base_clock' => 3.7,
                ],
                'ram' => [
                    'name' => 'Corsair Vengeance',
                    'capacity' => 16,
                    'speed' => 3200,
                ],
                'gpu' => [
                    'name' => 'NVIDIA RTX 3080',
                    'memory' => 10,
                    'clock' => 1710,
                ],
                'storage' => [
                    'name' => 'Samsung 970 EVO',
                    'capacity' => 1000,
                    'type' => 'SSD',
                ],
                'motherboard' => [
                    'name' => 'ASUS ROG STRIX B550-F',
                    'chipset' => 'B550',
                    'form_factor' => 'ATX',
                ],
                'psu' => [
                    'name' => 'Corsair RM750x',
                    'wattage' => 750,
                    'efficiency' => 90,
                ],
                'case' => [
                    'name' => 'NZXT H510',
                    'form_factor' => 'ATX',
                ],
            ]
        ];

        // Выполняем запрос от имени администратора
        $response = $this->actingAs($admin)->post(route('admin.computer.store'), $data);

        // Проверка перенаправления и успешного сообщения
        $response->assertRedirect(route('admin.computer.create'));
        $response->assertSessionHas('success', 'Компьютер успешно добавлен!');

        // Проверяем запись в бд
        $this->assertDatabaseHas('computers', ['name' => 'Test PC']);
    }

    /*
    * Тест, что обычный пользователь не может добавить пк
    */
    public function test_non_admin_cannot_add_computer(): void
    {
        // Создаём обычного пользователя
        $user = User::factory()->create();

        // Пробуем выполнить запрос от его имени
        $response = $this->actingAs($user)->post(route('admin.computer.store'), []);

        // Ожидаем, что доступ будет запрещён
        $response->assertForbidden();
    }

    /*
    * Тест ошибки валидации при добавлении пк
    */
    public function test_computer_store_validation_fails_on_missing_name_and_price(): void
    {
        // Создаём администратора
        $admin = User::factory()->admin()->create();

        // Отправляем данные с пустыми полями
        $data = [
            'name' => '',
            'price' => '',
            'components' => [],
        ];

        // Выполняем запрос от имени администратора
        $response = $this->actingAs($admin)->post(route('admin.computer.store'), $data);

        // Проверяем, что вернулись ошибки валидации для полей name и price
        $response->assertSessionHasErrors(['name', 'price']);
    }
}

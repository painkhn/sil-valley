<?php

namespace Tests\Feature;

use App\Models\{Computer, Component, User};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ComputerUpdateTest extends TestCase
{
    use RefreshDatabase;

    /*
    * Тест на успешное обновление компьютера администратором
    */
    public function test_admin_can_update_computer(): void
    {
        // Подготавливаем фейковое хранилище
        Storage::fake('public');

        // Создаём администратора и компьютер
        $admin = User::factory()->admin()->create();
        $computer = Computer::factory()->create([
            'name' => 'Old Name',
            'description' => 'Old description',
            'price' => 1000,
        ]);

        // Добавляем старый компонент
        $oldComponent = Component::factory()->create([
            'name' => 'Old CPU',
            'type' => 'CPU',
        ]);
        $computer->components()->attach($oldComponent);

        // Новые данные для обновления
        $data = [
            'name' => 'Updated PC',
            'description' => 'Updated description',
            'price' => 1999.99,
            'image' => UploadedFile::fake()->image('new-image.jpg'),

            'components' => [
                'cpu' => [
                    'name' => 'Intel Core i7-12700K',
                    'cores' => 12,
                    'threads' => 20,
                    'base_clock' => 3.6,
                ],
                'ram' => [
                    'name' => 'Kingston Fury',
                    'capacity' => 32,
                    'speed' => 3600,
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
                    'name' => 'ASUS ROG STRIX',
                    'chipset' => 'Z690',
                    'form_factor' => 'ATX',
                ],
                'psu' => [
                    'name' => 'Corsair RM850x',
                    'wattage' => 850,
                    'efficiency' => 90,
                ],
                'case' => [
                    'name' => 'NZXT H510',
                    'form_factor' => 'ATX',
                ],
            ],
        ];

        // Выполняем PATCH-запрос на обновление
        $response = $this->actingAs($admin)->patch(route('admin.computer.update', $computer), $data);

        // Проверка редиректа и успешного сообщения
        $response->assertRedirect('/');
        $response->assertSessionHas('success');

        // Проверка обновлений в БД
        $this->assertDatabaseHas('computers', [
            'id' => $computer->id,
            'name' => 'Updated PC',
            'price' => 2000,
        ]);
        $this->assertDatabaseHas('components', [
            'name' => 'Intel Core i7-12700K',
            'type' => 'CPU',
        ]);
        $this->assertDatabaseHas('components', [
            'name' => 'Kingston Fury',
            'type' => 'RAM',
        ]);

        // Проверка загрузки изображения
        Storage::disk('public')->assertExists('images/' . $data['image']->hashName());
    }

    /*
    * Тест на обновление пк с невалидными данными
    */
    public function test_admin_cannot_update_with_invalid_data(): void
    {
        Storage::fake('public');

        // Создаем администратора и компьютер
        $admin = User::factory()->admin()->create();
        $computer = Computer::factory()->create();

        // Некорректные данные
        $invalidData = [
            'name' => '',
            'description' => '',
            'price' => 'not-a-number',
            'image' => 'not-an-image',
            'components' => [
                'cpu' => [
                    'name' => '',
                    'cores' => 'abc',
                ],
            ],
        ];

        // Отправка PATCH-запроса
        $response = $this->actingAs($admin)->patch(route('admin.computer.update', $computer), $invalidData);

        // Проверка ошибок валидации
        $response->assertSessionHasErrors([
            'name',
            'price',
            'image',
            'components.cpu.name',
            'components.cpu.cores',
        ]);

        // Убеждаемся, что данные в базе не изменились
        $this->assertDatabaseHas('computers', [
            'id' => $computer->id,
            'name' => $computer->name,
        ]);
    }

    /*
    * Тест на ошибку, если не передано название компонента
    */
    public function test_update_computer_fails_when_component_name_missing(): void
    {
        Storage::fake('public');

        // Создаем администратора и компьютер
        $admin = User::factory()->admin()->create();
        $computer = Computer::factory()->create();

        // Данные без имени CPU
        $data = [
            'name' => 'Updated PC',
            'description' => 'Updated description',
            'price' => 1999.99,
            'image' => UploadedFile::fake()->image('image.jpg'),
            'components' => [
                'cpu' => [
                    'cores' => 8,
                    'threads' => 16,
                    'base_clock' => 3.6,
                ]
            ]
        ];

        // Отправка PATCH-запроса
        $response = $this->actingAs($admin)->patch(route('admin.computer.update', $computer), $data);

        // Проверка ошибки по имени CPU
        $response->assertSessionHasErrors(['components.cpu.name']);

        // Проверка, что компьютер не обновлён
        $this->assertDatabaseMissing('computers', ['name' => 'Updated PC']);
    }

    /*
    * Тест обновления с невалидной ценой
    */
    public function test_update_computer_fails_with_invalid_price(): void
    {
        Storage::fake('public');

        // Создаем администратора и компьютер
        $admin = User::factory()->admin()->create();
        $computer = Computer::factory()->create();

        // Данные с невалидной ценой
        $data = [
            'name' => 'Updated PC',
            'description' => 'Updated description',
            'price' => 'not-a-number',
            'image' => UploadedFile::fake()->image('image.jpg'),
            'components' => [
                'cpu' => [
                    'name' => 'Intel Core i7',
                    'cores' => 8,
                    'threads' => 16,
                    'base_clock' => 3.6,
                ]
            ]
        ];

        // Отправка PATCH-запроса
        $response = $this->actingAs($admin)->patch(route('admin.computer.update', $computer), $data);

        // Проверка ошибки по полю price
        $response->assertSessionHasErrors(['price']);

        // Убеждаемся, что компьютер не обновился
        $this->assertDatabaseMissing('computers', ['name' => 'Updated PC']);
    }

}

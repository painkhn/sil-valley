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

    public function test_admin_can_add_computer(): void
    {
        Storage::fake('public');

        $admin = User::factory()->admin()->create();

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

        $response = $this->actingAs($admin)->post(route('admin.computer.store'), $data);

        $response->assertRedirect(route('admin.computer.create'));
        $response->assertSessionHas('success', 'Компьютер успешно добавлен!');
        $this->assertDatabaseHas('computers', ['name' => 'Test PC']);
    }

    public function test_non_admin_cannot_add_computer(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.computer.store'), []);

        $response->assertForbidden();
    }

    public function test_computer_store_validation_fails_on_missing_name_and_price(): void
    {
        $admin = User::factory()->admin()->create();

        $data = [
            'name' => '',
            'price' => '',
            'components' => [],
        ];

        $response = $this->actingAs($admin)->post(route('admin.computer.store'), $data);

        $response->assertSessionHasErrors(['name', 'price']);
    }
}

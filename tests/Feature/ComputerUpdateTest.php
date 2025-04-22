<?php

namespace Tests\Feature;

use App\Models\Computer;
use App\Models\Component;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ComputerUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_computer(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();
        $computer = Computer::factory()->create([
            'name' => 'Old Name',
            'description' => 'Old description',
            'price' => 1000,
        ]);

        $oldComponent = Component::factory()->create([
            'name' => 'Old CPU',
            'type' => 'CPU',
        ]);

        $computer->components()->attach($oldComponent);
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

        $response = $this->actingAs($admin)->patch(route('admin.computer.update', $computer), $data);
        $response->assertRedirect('/');
        $response->assertSessionHas('success');
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

        Storage::disk('public')->assertExists('images/' . $data['image']->hashName());
    }

    public function test_admin_cannot_update_with_invalid_data(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();
        $computer = Computer::factory()->create();

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

        $response = $this->actingAs($admin)->patch(route('admin.computer.update', $computer), $invalidData);

        $response->assertSessionHasErrors([
            'name',
            'price',
            'image',
            'components.cpu.name',
            'components.cpu.cores',
        ]);

        $this->assertDatabaseHas('computers', [
            'id' => $computer->id,
            'name' => $computer->name,
        ]);
    }

    public function test_update_computer_fails_when_component_name_missing(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();
        $computer = Computer::factory()->create();

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

        $response = $this->actingAs($admin)->patch(route('admin.computer.update', $computer), $data);

        $response->assertSessionHasErrors(['components.cpu.name']);
        $this->assertDatabaseMissing('computers', ['name' => 'Updated PC']);
    }

    public function test_update_computer_fails_with_invalid_price(): void
    {
        Storage::fake('public');
        $admin = User::factory()->admin()->create();
        $computer = Computer::factory()->create();

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

        $response = $this->actingAs($admin)->patch(route('admin.computer.update', $computer), $data);

        $response->assertSessionHasErrors(['price']);
        $this->assertDatabaseMissing('computers', ['name' => 'Updated PC']);
    }
}

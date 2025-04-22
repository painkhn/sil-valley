<?php

namespace Tests\Feature;

use App\Models\Computer;
use App\Models\Component;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FavouriteTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_add_computer_to_favorites(): void
    {
        $user = User::factory()->create();
        $computer = Computer::factory()->create();

        $response = $this->actingAs($user)->post(route('favorites.store', $computer));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Товар добавлен в избранное');
        $this->assertDatabaseHas('favorites', [
            'user_id' => $user->id,
            'computer_id' => $computer->id,
        ]);
    }

    public function test_user_can_remove_computer_from_favorites(): void
    {
        $user = User::factory()->create();
        $computer = Computer::factory()->create();

        $user->favorites()->create(['computer_id' => $computer->id]);

        $response = $this->actingAs($user)->post(route('favorites.store', $computer));

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Товар удалён из избранного');
        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'computer_id' => $computer->id,
        ]);
    }

    public function test_guest_cannot_toggle_favorites(): void
    {
        $computer = Computer::factory()->create();

        $response = $this->post(route('favorites.store', $computer));

        $response->assertRedirect(route('login'));
        $this->assertDatabaseMissing('favorites', [
            'computer_id' => $computer->id,
        ]);
    }

    public function test_user_cannot_favorite_nonexistent_computer(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('favorites.store', ['computer' => 99999]));

        $response->assertNotFound();
        $this->assertDatabaseMissing('favorites', [
            'user_id' => $user->id,
            'computer_id' => 99999,
        ]);
    }
}

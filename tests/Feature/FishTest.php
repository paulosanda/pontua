<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class FishTest extends TestCase
{
    use RefreshDatabase;

    public function test_fish_index_route(): void
    {
        $user = User::factory()->createOne();

        $this->actingAs($user)->get(route('fish.index'), [
            'name' => 'Tucunare',
            'scientific_name' => 'Cichla ocellaris'
        ])->assertOk();
    }
    public function test_fish_store_route(): void
    {
        $user = User::factory()->createOne();

        $this->actingAs($user)->post(route('fish.add'), [
            'name' => 'Tucunare',
            'scientific_name' => 'Cichla ocellaris'
        ]);

        $this->assertDatabaseHas('fishes', [
            'name' => 'Tucunare',
            'scientific_name' => 'Cichla ocellaris'
        ]);
    }

    public function test_fish_update_route(): void
    {
        $user = User::factory()->createOne();

        $fish = $this->actingAs($user)->post(route('fish.add'), [
            'name' => 'Tucunare',
            'scientific_name' => 'Cichla ocellaris'
        ]);

        $this->actingAs($user)->put(route('fish.edit', $fish['id']), [
            'name' => 'Tucunare Azul',
            'scientific_name' => 'Cichla piquiti'
        ]);

        $this->assertDatabaseHas('fishes', [
            'name' => 'Tucunare Azul',
            'scientific_name' => 'Cichla piquiti'
        ]);
    }

    public function test_fish_delete_route(): void
    {
        $user = User::factory()->createOne();

        $fish = $this->actingAs($user)->post(route('fish.add'), [
            'name' => 'Tucunare',
            'scientific_name' => 'Cichla ocellaris'
        ]);

        $this->actingAs($user)->delete(route('fish.delete', $fish['id']));

        $this->assertDatabaseEmpty('fishes');
    }
}

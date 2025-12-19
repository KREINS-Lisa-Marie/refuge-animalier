<?php

namespace Database\Seeders;

use App\Models\Animal;
use App\Models\Availability;
use App\Models\Message;
use App\Models\Request;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user1 = User::factory()->create([
            'first_name' => 'TestFirstName',
            'last_name' => 'TestLastName',
            'email' => 'test@test.com',
            'phone' => '0123456789',
            'role' => 'Admin',
            'is_admin' => true,
            'profile_image' => 'felfjzsofezns.jpg',
            'password' => Hash::make('test'),
        ]);
    }
}

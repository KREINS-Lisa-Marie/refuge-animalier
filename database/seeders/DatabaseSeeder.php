<?php

namespace Database\Seeders;

use App\Enums\Sex;
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

        if (!User::where('email', 'lisa-marie.kreins@student.hepl.be')->exists()) {
            $user = User::create([
                'first_name' => 'TestFirstName',
                'last_name' => 'TestLastName',
                'email' => 'lisa-marie.kreins@student.hepl.be',
                'phone' => '0123456789',
                'is_admin' => true,
                'password' => Hash::make(config('admin.password')),
            ]);
        }

        if (!User::where('email', 'elise@lambot.com')->exists()) {
            $elise = User::create([
                'first_name' => 'Elise',
                'last_name' => 'Lambot',
                'email' => 'elise@lambot.com',
                'phone' => '0123456789',
                'is_admin' => true,
                'password' => Hash::make(config('admin.password')),
            ]);
        }

        if (!User::where('email', 'thomas@fortin.com')->exists()) {
            $thomas = User::create([
                'first_name' => 'Thomas',
                'last_name' => 'Fortin',
                'email' => 'thomas@fortin.com',
                'phone' => '0123456789',
                'is_admin' => false,
                'password' => Hash::make(config('admin.volunteer_password')),
            ]);
        }

        if ($user && !Availability::where('user_id', $user->id)->exists()) {
            Availability::create([
                'user_id' => $user->id,
                'monday' => '10-12',
                'tuesday' => '12-17',
                'wednesday' => '10-13',
                'thursday' => '/',
                'friday' => '/',
                'saturday' => '/',
                'sunday' => '15-19',
            ]);
        }

        if ($elise && !Availability::where('user_id', $elise->id)->exists()) {
            Availability::create([
                'user_id' => $elise->id,
                'monday' => '8-12',
                'tuesday' => '12-17',
                'wednesday' => '10-13',
                'thursday' => '/',
                'friday' => '/',
                'saturday' => '7-13',
                'sunday' => '10-13',
            ]);
        }

        if ($thomas && !Availability::where('user_id', $thomas->id)->exists()) {
            Availability::create([
                'user_id' => $thomas->id,
                'monday' => '8-12',
                'tuesday' => '12-17',
                'wednesday' => '10-13',
                'thursday' => '15-19',
                'friday' => '10-19',
                'saturday' => '10-19',
                'sunday' => '/',
            ]);
        }

        /*Availability::factory()->for($user)->create();

        User::factory(5)
            ->hasAvailability()
            ->create();

        $animals = Animal::factory()->count(30)->create();
        $messages = Message::factory()->count(10)->create();

        $animal = Animal::factory()->create();
        $adoptables = Animal::factory(10)->create(['state' => 'adoptable']);

        //j'ai fait for i parce que sinon ça garde le même id pour tous
        for ($i = 0; $i<10; $i++){
            Request::factory()->create([
                'animal_id'=>$adoptables->random()->id,
            ]);
        }*/
    }
}

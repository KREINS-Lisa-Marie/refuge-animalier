<?php

use App\Models\User;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;
use Illuminate\Support\Facades\Storage;
use function Pest\Laravel\actingAs;

uses(RefreshDatabase::class);

beforeEach(function(){
    $this-> user = User::factory()-> create();
    \Pest\Laravel\actingAs($this-> user);});


it('renders successfully', function () {
    Livewire::test('pages::animals.create')
        ->assertStatus(200);
});

it('verifies that the animals create page is showing content elements in the right order', function () {
    Livewire::test('pages::animals.create')
        ->assertStatus(200)
        ->assertSee(['Créer un animal', 'Informations générales', 'Nom', 'Espèce', 'Statut', 'Description', 'Image',  ]);
});


it('redirects to the animals index route after the successfull creation of an animal',
    function () {

    $user = User::factory()->create(['is_admin' => '1']);
        $locale = app()->getLocale();
        actingAs($user);


        Storage::fake('public');
        $animal_image = UploadedFile::fake()->image('animal.jpg');

        Livewire::test('pages::animals.create')
            ->set('animal_name', 'Bert')
            ->set('species', 'dog')
            ->set('race', 'Dalmatian')
            ->set('sex', 'male')
            ->set('fur', 'brown')
            ->set('age', '2022-03-03')
            ->set('vaccinations', 'non')
            ->set('character', 'non')
            ->set('state', 'adoptable')
            ->set('description', 'non non')
            ->set('show_image', $animal_image)
            ->set('published_animal', '1')
            ->call('store')
            ->assertHasNoErrors();

        $new_animal = \App\Models\Animal::where('animal_name', 'Bert')->first();
        expect($new_animal)->not()->toBeNull();
        expect($new_animal->show_image)->not()->toBeNull();
        Storage::disk('public')->assertExists($new_animal->show_image);

        $image = Image::decode(Storage::disk('public')->get($new_animal->show_image));

        expect($image->width())
            ->toBeLessThanOrEqual(334)
            ->and($image->height())
            ->toBeLessThanOrEqual(334);
    });

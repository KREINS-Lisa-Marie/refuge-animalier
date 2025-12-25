<?php

namespace App\Http\Controllers;

use App\Enums\AnimalState;
use App\Models\Animal;

class AnimalController extends Controller
{
    public function index()
    {
        $animals = Animal::where('state', 'adoptable')->get();
        return view('public.animals', compact('animals'));
    }
    public function show(  String $locale, Animal $animal)
    {
        return view('public.animal', compact('animal'));
    }
}

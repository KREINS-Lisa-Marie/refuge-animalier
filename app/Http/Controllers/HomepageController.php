<?php

namespace App\Http\Controllers;

use App\Models\Animal;

class HomepageController extends Controller
{
    public function index()
    {
        $animals = Animal::where('state', 'adoptable')->get();
        return view('public.homepage', compact('animals'));
    }
}

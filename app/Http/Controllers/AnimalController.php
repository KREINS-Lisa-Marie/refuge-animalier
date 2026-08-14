<?php

namespace App\Http\Controllers;

use App\Enums\AnimalState;
use App\Models\Animal;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index()
    {

        $search = request('search', '');        //prend soit ce que je cherche dans search, soit affiche tous les animaux
        $age = request('age', '');
        $sex = request('sex', '');
        $species = request('species', '');

        $sex_options = [
            [
                'name' => __('public/animals.male'),
                'value' =>'male',
            ],
            [
                'name' => __('public/animals.female'),
                'value' =>'female',
            ],
        ];

        $species_options = [
            [
                'name' => __('public/animals.cat'),
                'value' =>'cat',
            ],
            [
                'name' => __('public/animals.dog'),
                'value' =>'dog',
            ],
            [
                'name' => __('public/animals.bunny'),
                'value' =>'bunny',
            ],
            [
                'name' => __('public/animals.hamster'),
                'value' =>'hamster',
            ],
        ];

        $age_options = [
            [
                'name' => __('public/animals.under_one'),
                'value' =>'<1',
            ],
            [
                'name' => __('public/animals.one_years'),
                'value' =>1,
            ],
            [
                'name' => __('public/animals.two_years'),
                'value' =>2,
            ],
            [
                'name' => __('public/animals.three_years'),
                'value' =>3,
            ],
            [
                'name' => __('public/animals.four_years'),
                'value' =>4,
            ],
            [
                'name' => __('public/animals.five_years'),
                'value' =>5,
            ],
            [
                'name' => __('public/animals.six_years'),
                'value' =>6,
            ],
            [
                'name' => __('public/animals.seven_years'),
                'value' => 7,
            ],
            [
                'name' => __('public/animals.eight_years'),
                'value' =>8,
            ],
            [
                'name' => __('public/animals.nine_years'),
                'value' =>9,
            ],
            [
                'name' => __('public/animals.ten_years'),
                'value' =>10,
            ],
            [
                'name' => __('public/animals.eleven_years'),
                'value' =>11,
            ],
            [
                'name' => __('public/animals.twelve_years'),
                'value' =>12,
            ],
            [
                'name' => __('public/animals.thirteen_years'),
                'value' =>13,
            ],
            [
                'name' => __('public/animals.fourteen_years'),
                'value' =>14,
            ],
            [
                'name' => __('public/animals.fifteen_years'),
                'value' =>15,
            ],
            [
                'name' => __('public/animals.sixteen_years'),
                'value' =>16,
            ],
            [
                'name' => __('public/animals.seventeen_years'),
                'value' =>17,
            ],
            [
                'name' => __('public/animals.eighteen_years'),
                'value' =>18,
            ],
            [
                'name' => __('public/animals.nineteen_years'),
                'value' =>19,
            ],
            [
                'name' => __('public/animals.twenty_years'),
                'value' =>20,
            ],
        ];

        $filter_animals = Animal::where('state', '!=', 'adopted')
            ->where('published_animal', true)
            ->whereAny(['animal_name', 'species', 'race', 'sex', 'fur', 'character'], 'like', '%' . $search . '%');


        if ($age){
            $filter_animals->where('age', 'like', '%'.$age.'%');
        }
        if ($sex){
            $filter_animals->where('sex', $sex);
        }
        if ($species){
            $filter_animals->where('species', $species);
        }

        $animals= $filter_animals->orderBy('animal_name', 'asc')
            ->paginate(6)->onEachSide(0);


        $similar_animals = [];
        $similar = Animal::where('state', '!=', 'adopted')
            ->where('published_animal', true)
            ->whereNotIn('id', $animals->pluck('id'));      //pas les mêmes id que animaux déjà affichés

        if ($species){
            $similar->where('species', $species);
        }
   /*         if ($age){            //enlevé sinon trouve pas bcp de résultats
                $similar->where('age', $age);
            }*/
        if ($sex){
            $similar->where('sex', $sex);
        }
        $similar_animals = $similar->inRandomOrder()->limit(3)->get();
        $random_animals = Animal::where('published_animal', true)->inRandomOrder()->limit(3)->get();

        return view('public.animals', ['animals' => $animals, 'species_options' => $species_options, 'sex_options' => $sex_options, 'age_options' => $age_options, 'title' => __('general.our_animals'), 'similar_animals'=>$similar_animals, 'random_animals'=>$random_animals]);
    }


    public function show(  String $locale, Animal $animal)
    {
        return view('public.animal', [
            'animal' => $animal,
            'title' => __('general.animal_details'),
            'successMessage' => '',
        ]);
    }

    public function store(Request $request, String $locale, Animal $animal)
    {
        $request->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'string|required|max:255',
            'phone'=>'string|required',
            'email'=>'email|required',
            'message'=>'string|required',
        ]);

        $adoptionRequest = \App\Models\Request::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
            'state' => 'not_treated_yet',
            'animal_id' => $animal->id,
        ]);


        $admin = \App\Models\User::where('is_admin', '1')->first();

        \Mail::to($admin->email)->queue(new  \App\Mail\AdoptionRequestCreatedMail($adoptionRequest));



        $this->successMessage = __('public/animal.form_sent');

        return redirect(route('public.animal', ['locale' => $locale, 'animal' => $animal]) . '#request')->with(
                'successMessage', __('public/animal.form_sent'),
                );
    }
}

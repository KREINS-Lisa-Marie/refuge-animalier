<?php

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

new class extends Component
{
    use PasswordValidationRules;


    public string $first_name = '';
    public string $last_name = '';
    public string $email= '' ;
    public string $phone ='';
    public string $profile_image= '';
    public bool $is_admin = false;
    public string $password = '';
    public string $password_confirmation = '';
    public string $monday = '';
    public string $tuesday = '';
    public string $wednesday = '';
    public string $thursday = '';
    public string $friday = '';
    public string $saturday = '';
    public string $sunday = '';

    public function store(): void
    {
        $validated_data= $this->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'string|required|max:255',
            'email'=>['required','string','email','max:255',Rule::unique('users')],
            'phone'=>'required|string',
            'profile_image'=>'nullable|string',
            'is_admin'=>'required|boolean',
            'password'=>$this->updatePasswordRules(),
            'monday'=>'string|nullable',
            'tuesday'=>'string|nullable',
            'wednesday'=>'string|nullable',
            'thursday'=>'string|nullable',
            'friday'=>'string|nullable',
            'saturday'=>'string|nullable',
            'sunday'=>'string|nullable',
        ]);


        $user = User::create([
            'first_name'=>$validated_data['first_name'],
            'last_name'=>$validated_data['last_name'],
            'email'=>$validated_data['email'],
            'phone'=>$validated_data['phone'],
            'profile_image'=>$validated_data['profile_image'],
            'is_admin'=>$validated_data['is_admin'],
            'password'=>Hash::make($validated_data['password']),
        ]);


        \App\Models\Availability::create([
            'user_id'=> $user->id,
            'monday'=>$validated_data['monday']??'',
            'tuesday'=>$validated_data['tuesday']??'',
            'wednesday'=>$validated_data['wednesday']??'',
            'thursday'=>$validated_data['thursday']??'',
            'friday'=>$validated_data['friday']??'',
            'saturday'=>$validated_data['saturday']??'',
            'sunday'=>$validated_data['sunday']??'',
        ]);

        $this->redirect(route('pages::volunteers.index', ['locale' => __('general.currentLocale')]));
    }

    public function render()
    {
        return view('pages.volunteers.⚡create.create')->title(__('general.volunteers_create'));
    }

};

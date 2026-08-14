<?php

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    use PasswordValidationRules;
    use WithFileUploads;

    public string $first_name = '';
    public string $last_name = '';
    public string $email= '' ;
    public string $phone ='';
    public $profile_image= null ;
    public string $is_admin;
    public string $password = '';
    public string $password_confirmation = '';
    public string $monday = '';
    public string $tuesday = '';
    public string $wednesday = '';
    public string $thursday = '';
    public string $friday = '';
    public string $saturday = '';
    public string $sunday = '';


    public function mount(): void
    {
        $this->authorize('create', User::class);

    }

    public function store(): void
    {
        $this->authorize('create', User::class);

        $validated_data= $this->validate([
            'first_name'=>'required|string|max:255',
            'last_name'=>'string|required|max:255',
            'email'=>['required','string','email','max:255',Rule::unique('users')],
            'phone'=>'required|string',
            'profile_image'=>'image|nullable|mimes:jpg,jpeg,png,webp',
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


        if ($this->profile_image){
            $image_path = $this->profile_image->store(config('userimage.originals_path'), 'public');
            $filename = basename($image_path); // = juste le nom de l'image sans les dossiers etc
            $image = Image::decode(          //marche pas avec read
                Storage::disk('public')->get($image_path)
            );
            $sizes = config('userimage.sizes');
            $extension = config('userimage.jpg_image_type');
            $compression = config('userimage.jpg_compression');

            foreach ($sizes as $size){
                $variant = clone $image;

                $variant->scale($size['width']);
                $variant_path = sprintf(
                    config('userimage.variants_path_pattern'),
                    $size['width'],
                    $size['height']
                );
                \Storage::disk('public')->put($variant_path.'/'.$filename,
                    $variant->encodeUsingFormat(\Intervention\Image\Format::JPEG, quality: $compression));
            }
        }
        else{
            $image_path = null;
        }


        $user = User::create([
            'first_name'=>$validated_data['first_name'],
            'last_name'=>$validated_data['last_name'],
            'email'=>$validated_data['email'],
            'phone'=>$validated_data['phone'],
            'profile_image'=>$image_path,
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

        \Mail::to($user->email)->queue(new  \App\Mail\UserCreatedMail($user, $this->password));

        $this->redirect(route('pages::volunteers.index', ['locale' => app()->getLocale()]));

    }

    public function render()
    {
        return view('pages.volunteers.⚡create.create')->title(__('general.volunteers_create'));
    }

};

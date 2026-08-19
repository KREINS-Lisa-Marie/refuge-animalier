<?php

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;

new class extends Component {
    use PasswordValidationRules;
    use WithFileUploads;

    public $user;
    public string $first_name = '';
    public string $last_name = '';
    public string $email= '' ;
    public string $is_admin= '' ;
    public string $phone ='';
    public $profile_image = null ;
    public string $password = '';
    public string $password_confirmation = '';

    public $image_path = [];

    public function mount(User $user): void
    {
        $this->user = \Auth::user();
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->email = $this->user->email;
        $this->phone = $this->user->phone ?? '';
        $this->is_admin = $this->user->is_admin;
        $this->profile_image = $this->user->profile_image?? null;
    }

    public function save(): void
    {
        $validation_rules=    [
            'first_name' => 'required|string|max:255',
            'last_name' => 'string|required|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user->id)],
            'phone' => 'required|string',
            /*'profile_image' => 'image|nullable|mimes:jpg,jpeg,png,webp',*/
        ];

        if (!is_string($this->profile_image)){
            $validation_rules['profile_image'] =  'image|nullable|mimes:jpg,jpeg,png,webp';
        }
        $validated_data = $this->validate($validation_rules);


        if ($this->profile_image && !is_string($this->profile_image)){
            $image_path = $this->profile_image->store(config('userimage.originals_path'), 's3');
            $filename = basename($image_path);        // = juste le nom de l'image sans les dossiers etc
            $image = Image::decode(         //marche pas avec read
                Storage::disk('s3')->get($image_path)
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
                \Storage::disk('s3')->put($variant_path.'/'.$filename,
                    $variant->encodeUsingFormat(\Intervention\Image\Format::JPEG, quality: $compression));
            }
        }
        elseif (is_string($this->profile_image)){      //si c'est une image déjà uploadé et sauvé avant
            $image_path = $this->profile_image;
        }
        else{       //si c'est null ou vide
            $image_path = null;
        }

        $this->user->update([
            'first_name' => $validated_data['first_name'],
            'last_name' => $validated_data['last_name'],
            'email' => $validated_data['email'],
            'phone' => $validated_data['phone'],
            'is_admin' => $this->user->is_admin,
            'profile_image' => $image_path,
        ]);

        $this->redirect(route('pages::profile.index', ['locale' => app()->getLocale(), 'volunteer'=>$this->user]));
    }

    public function updatePassword()
    {
        $validated_data = $this->validate([
            'password'=>$this->updatePasswordRules(),
        ]);

        $this->user->update([
            'password'=>Hash::make($validated_data['password']),
        ]);

        $this->password = '';       //mettre vide par après
        $this->password_confirmation = '';       //mettre vide par après

        $this->redirect(route('pages::profile.index', ['locale' => app()->getLocale(), 'volunteer'=>$this->user]));

    }

    public function render()
    {
        return view('pages.profile.⚡edit.edit')->title(__('general.profile-edit'));
    }
};

<?php

use App\Models\Availability;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;

new class extends Component
{
    use WithFileUploads;

    public User $volunteer;
    public ?Availability $availabilities;

    public string $first_name ;
    public string $last_name ;
    public string $email ;
    public string $phone ;
    public $profile_image = null ;
    public string $is_admin;
    public string $password;
    public string $password_confirmation ;
    public string $monday ;
    public string $tuesday ;
    public string $wednesday ;
    public string $thursday ;
    public string $friday;
    public string $saturday;
    public string $sunday;

    public $image_path = [];

    public function mount(User $volunteer): void
    {
        $this->authorize('update', $volunteer);

        $this->volunteer = $volunteer;
        $this->availabilities = Availability::where('user_id', $volunteer->id)->first();
        $this->first_name = $volunteer->first_name;
        $this->last_name = $volunteer->last_name;
        $this->email = $volunteer->email;
        $this->phone = $volunteer->phone ?? '';
        //$this->profile_image = $volunteer->profile_image?? null;
        $this->profile_image = $volunteer->profile_image?? null;
        $this->is_admin = $volunteer->is_admin ? '1' : '0';
        $this->monday = $this->availabilities->monday ?? '';
        $this->tuesday = $this->availabilities->tuesday ?? '';
        $this->wednesday = $this->availabilities->wednesday ?? '';
        $this->thursday = $this->availabilities->thursday ?? '';
        $this->friday = $this->availabilities->friday ?? '';
        $this->saturday = $this->availabilities->saturday ?? '';
        $this->sunday = $this->availabilities->sunday ?? '';
    }

    public function save(): void
    {
        $this->authorize('update', $this->volunteer);

        $validation_rules=    [
            'first_name' => 'required|string|max:255',
            'last_name' => 'string|required|max:255',
            'phone' => 'required|string',
            /*'profile_image' => 'image|nullable|mimes:jpg,jpeg,png,webp',*/
            'is_admin' => 'required|boolean',
            'monday' => 'string|nullable',
            'tuesday' => 'string|nullable',
            'wednesday' => 'string|nullable',
            'thursday' => 'string|nullable',
            'friday' => 'string|nullable',
            'saturday' => 'string|nullable',
            'sunday' => 'string|nullable',
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



         $this->volunteer->update([
            'first_name' => $validated_data['first_name'],
            'last_name' => $validated_data['last_name'],
            'email' => $this->volunteer->email,
            'phone' => $validated_data['phone'],
            'profile_image' =>  $image_path,
             'is_admin' => $validated_data['is_admin'] === '1'      //si = 1 alors = true sinon false
        ]);


        Availability::updateOrCreate(
            ['user_id' => $this->volunteer->id],
            [
                'monday' =>  $validated_data['monday'],
            'tuesday' =>  $validated_data['tuesday'],
            'wednesday' =>  $validated_data['wednesday'],
            'thursday' =>  $validated_data['thursday'],
            'friday' =>  $validated_data['friday'],
            'saturday' =>  $validated_data['saturday'],
            'sunday' =>  $validated_data['sunday'],
            ],
             );

        $this->redirect(route('pages::volunteers.show', ['locale' => app()->getLocale(), 'volunteer'=>$this->volunteer]));
}

    public function render()
    {
        return view('pages.volunteers.⚡edit.edit')->title(__('general.volunteers_edit'));
    }
};

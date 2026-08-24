<?php

use App\Models\Animal;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

new class extends Component
{

    use WithFileUploads;

    public Animal $animal;
    public string $animal_name = '';
    public string $species;
    public string $race = '';
    public string $sex = '';
    public string $fur = '';
    public $age = '';
    public string $vaccinations = '';
    public string $character = '';
    public string $state = '';
    public string $description = '';
    public $show_image  = null ;
    public string $internal_notes = '';
    public string $modification_request = '';
    public $published_animal;
    public $gallery_images = [];
    public $gallery_images_paths = [];


    public function mount(Animal $animal): void
    {
        $this->authorize('update', $animal);
        //$this->authorize('updateLimited', $this->animal);


        $this->animal = $animal;
        $this->animal_name = $animal->animal_name;
        $this->species = $animal->species;
        $this->race = $animal->race ?? '';
        $this->sex = $animal->sex;
        $this->fur = $animal->fur ?? '';
        $this->age = $animal->age ?? '';
        $this->vaccinations = $animal->vaccinations;
        $this->character = $animal->character ?? '';
        $this->state = $animal->state;
        $this->description = $animal->description ?? '';
        $this->show_image = $animal->show_image ?? null;
        $this->internal_notes = $animal->internal_notes ?? '';
        $this->modification_request = $animal->modification_request ?? '';
        $this->published_animal = $animal->published_animal ?? '0';

        $gallery = $animal->gallery_images;

        if (is_string($gallery)) {
            $gallery = json_decode($gallery, true) ?: [];
        }
        $this->gallery_images = is_array($gallery) ? $gallery : [];

    }


    public function removeFromGallery($index)
    {
        unset($this->gallery_images[$index]);       //supprime cette image
        $this->gallery_images = array_values($this->gallery_images);        //faut renumérer par ce que sinon ça bug
    }

    public $new_gallery_images =[];

    public function updatedNewGalleryImages()
    {
        //dd($this->new_gallery_images);

        if (is_array($this->new_gallery_images)){
            foreach ($this->new_gallery_images as $image) {
                $this->gallery_images[] = $image;
            }   // ajouter les nouvelles images au array
        }
        $this->new_gallery_images = [];
        //vider array après
    }


    public function save(): void
    {
        $this->authorize('update', $this->animal);
       // $this->authorize('updateLimited', $this->animal);


        $validation_rules=    [
            'animal_name'=>'required|string|max:255',
            'species'=>'required|string',
            'race'=>'string|nullable',
            'sex'=>'required|string',
            'fur'=>'string|nullable',
            'age'=>'required|date',
            'vaccinations'=>'string|nullable',
            'character'=>'string|nullable',
            'state'=>'required|string',
            'description'=>'string|nullable',
            //'show_image'=>'image|nullable|mimes:jpg,jpeg,png,webp',
            'internal_notes'=>'string|nullable',
            'modification_request'=>'string|nullable',
            'published_animal'=>'required|boolean', 'gallery_images'=>'array|nullable|max:3',
            //'gallery_images.*'=>'image|nullable|mimes:jpg,jpeg,png,webp',
        ];

        if (!is_string($this->show_image)){
            $validation_rules['show_image'] =  'image|nullable|mimes:jpg,jpeg,png,webp|max:2048';
        }

        foreach ($this->gallery_images as $index => $img){
        if (!is_string($img)){
            $validation_rules["gallery_images.$index"] =  'image|nullable|mimes:jpg,jpeg,png,webp|max:2048';
        }
        }

        $validated_data = $this->validate($validation_rules);

        $sizes = config('animalimage.sizes');
        $compression = config('animalimage.jpg_compression');

        if ($this->show_image && !is_string($this->show_image)){        //si c'est un nouveau upload
            $show_image_path = $this->show_image->store(config('animalimage.originals_path'), 's3');

            $filename = basename($show_image_path);        // = juste le nom de l'image sans les dossiers etc
            $image = Image::decode(         //marche pas avec read
                Storage::disk('s3')->get($show_image_path)
            );

            $extension = config('animalimage.jpg_image_type');

            foreach ($sizes as $size){
                $variant = clone $image;

                $variant->scale($size['width']);
                $variant_path = sprintf(
                    config('animalimage.variants_path_pattern'),
                    $size['width'],
                    $size['height']
                );
                \Storage::disk('s3')->put($variant_path.'/'.$filename,
                    $variant->encodeUsingFormat(\Intervention\Image\Format::JPEG, quality: $compression));
            }

        }
        elseif (is_string($this->show_image)){      //si c'est une image déjà uploadé et sauvé avant
            $show_image_path = $this->show_image;
        }
        else{       //si c'est null ou vide
            $show_image_path = null;
        }


        //gallerie

        $gallery_images_paths = [];

        if ($this->gallery_images) {
            foreach ($this->gallery_images as $gallery_image) {

                if (is_string($gallery_image)) {
                    $gallery_images_paths[] = $gallery_image;
                }
                else{

                $gallery_image_path = $gallery_image->store(config('animalimage.originals_path'), 's3');

                \App\Jobs\ProcessAnimalImage::dispatch($gallery_image_path);

                // ajouter chaque image au array
                $gallery_images_paths[] = $gallery_image_path;
                }
            }
        }
        else{
            $gallery_image_path = null;
        }



        $this->animal->update([
            'animal_name'=>$validated_data['animal_name'],
            'species'=>$validated_data['species'],
            'race'=>$validated_data['race'],
            'sex'=>$validated_data['sex'],
            'fur'=>$validated_data['fur'],
            'age'=>$validated_data['age'],
            'vaccinations'=>$validated_data['vaccinations'],
            'character'=>$validated_data['character'],
            'state'=>$validated_data['state'],
            'description'=>$validated_data['description'],
            'show_image'=>$show_image_path,
            'gallery_images' => $gallery_images_paths,
            'internal_notes'=>$validated_data['internal_notes'],
            'modification_request'=>$validated_data['modification_request'],
            'published_animal'=>$validated_data['published_animal'] ?? false,
        ]);

        $admin = \App\Models\User::where('is_admin', '1')->first();

        \Mail::to($admin->email)->queue(new  \App\Mail\AnimalUpdatedMail($this->animal));




        $this->redirect(route('pages::animals.show', ['locale' => app()->getLocale(), 'animal' => $this->animal])
    );
    }

    public function render()
    {
        $animal_state_options =[
            [
                'name' => __('admin/animals.adopted'),
                'value' =>'adopted',
            ],
            [
                'name' => __('admin/animals.processing_adoption'),
                'value' =>'processing_adoption',
            ],
            [
                'name' => __('admin/animals.in_treatment'),
                'value' =>'in_treatment',
            ],
            [
                'name' => __('admin/animals.adoptable'),
                'value' =>'adoptable',
            ],
        ];
        $gender = [
            [
                'name' => __('admin/animals.male'),
                'value' =>'male',
            ],
            [
                'name' => __('admin/animals.female'),
                'value' =>'female',
            ],
        ];
        $published_animal_options = [ [
            'name' => __('admin/animals.published'),
            'value' =>'1',
        ],
            [
                'name' => __('admin/animals.not_published'),
                'value' =>'0',
            ],
        ];
        $species_options = [
            [
                'name' => __('admin/animals.dog'),
                'value' =>'dog',
            ],
            [
                'name' => __('admin/animals.cat'),
                'value' =>'cat',
            ],
            [
                'name' => __('admin/animals.hamster'),
                'value' =>'hamster',
            ],
            [
                'name' => __('admin/animals.bunny'),
                'value' =>'rabbit',
            ],
        ];

        return view('pages.animals.⚡edit.edit', compact('animal_state_options', 'gender', 'species_options', 'published_animal_options'))
            ->title(__('general.animals_edit'));
    }
};

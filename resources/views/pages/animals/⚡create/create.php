<?php
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

new #[Layout('layouts.app')] class extends Component
{
    use WithFileUploads;

    public string $animal_name ='';
    public string $species ='';
    public string $race = '';
    public string $sex ='';
    public string $fur = '';
    public string $age ='';
    public string $vaccinations = '';
    public string $character = '';
    public string $state='';
    public string $description = '';
    public $show_image = null;
    public string $internal_notes = '';
    public string $modification_request = '';
    public $published_animal;
    public $gallery_images = [];
    public $gallery_images_paths = [];


    public function mount()
    {
        $this->authorize('create', \App\Models\Animal::class);
        $this->published_animal = '0';      // je dois le faire pour présélectionner pour les volunteers qui ne peuvent pas séléctionner ça
    }

    public function render()        //à chaque fois que qqch sur la page change
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

        $user = auth()->user();
        return view('pages.animals.⚡create.create',['gender' => $gender, 'user' => $user, 'animal_state_options'=>$animal_state_options, 'species_options'=>$species_options, 'published_animal_options'=>$published_animal_options] )->title(__('general.animals_create'));
    }

    public function removeFromGallery($index)
    {
        unset($this->gallery_images[$index]);       //supprime cette image
        $this->gallery_images = array_values($this->gallery_images);        //faut renumérer par ce que sinon ça bug
    }

    public $new_gallery_image = null;

    public function updatedNewGalleryImage()
    {
        dd($this->new_gallery_image);
        if ($this->new_gallery_image) {
            $this->gallery_images[] = $this->new_gallery_image;
            $this->new_gallery_image = null;
        //vider array après
        }
    }


    public function store(): void
    {
        //dd($this->show_image);

        $this->authorize('create', \App\Models\Animal::class);

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

        $this->validate([
            'animal_name'=>'required|string|max:255',
            'species'=>'string|required',
            'race'=>'string|nullable',
            'sex'=>'string|required',
            'fur'=>'string|nullable',
            'age'=>'date|required',
            'vaccinations'=>'string|nullable',
            'character'=>'string|nullable',
            'state'=>'string|required',
            'description'=>'string|nullable',
            'show_image'=>'image|nullable|mimes:jpg,jpeg,png,webp',
            'internal_notes'=>'string|nullable',
            'modification_request'=>'string|nullable',
            'published_animal'=>'required|boolean',
            'gallery_images'=>'array|nullable|max:3',
            'gallery_images.*'=>'image|nullable|mimes:jpg,jpeg,png,webp',
        ]);


        if ($this->show_image){
           $show_image_path = $this->show_image->store(config('animalimage.originals_path'), 's3');
//            $show_image_path = $this->show_image->store(config('animalimage.originals_path'), 'public');

            $sizes = config('animalimage.sizes');
            $compression = config('animalimage.jpg_compression');


            $filename = basename($show_image_path); // = juste le nom de l'image sans les dossiers etc
            $image = Image::decode(          //marche pas avec read
                Storage::disk('s3')->get($show_image_path)
//                Storage::disk('public')->get($show_image_path)
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
//                \Storage::disk('public')->put($variant_path.'/'.$filename,
                    $variant->encodeUsingFormat(\Intervention\Image\Format::JPEG, quality: $compression));
            }


        }
        else{
            $show_image_path = null;
        }
        //dd($show_image_path);

        //gallerie

        $gallery_images_paths = [];

        if ($this->gallery_images) {
            foreach ($this->gallery_images as $gallery_image) {
                $gallery_image_path = $gallery_image->store(config('animalimage.originals_path'), 's3');
                //\App\Jobs\ProcessAnimalImage::dispatch($gallery_image);
                /* J'utilise un job car pour la gallerie l'upload peut durer longtemps et bloquer ou bugger la page. Comme ça l'utilisateur peut continuer comme normal*/

                $sizes = config('animalimage.sizes');
                $compression = config('animalimage.jpg_compression');


                $filename = basename($gallery_image_path); // = juste le nom de l'image sans les dossiers etc
                $image = Image::decode(          //marche pas avec read
                //Storage::disk('s3')->get($this->image_path)
                    Storage::disk('s3')->get($gallery_image_path)
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
                    //\Storage::disk('s3')->put($variant_path.'/'.$filename,
                    \Storage::disk('s3')->put($variant_path . '/' . $filename,
                        $variant->encodeUsingFormat(\Intervention\Image\Format::JPEG, quality: $compression));
                }


                $gallery_images_paths[] = $gallery_image_path;   // ajouter chaque image au array
            }
        }
        else{
                $gallery_image_path = null;
            }


        $animal = \App\Models\Animal::create([
            'animal_name' => $this->animal_name,
            'species' => $this->species,
            'race' => $this->race,
            'sex' => $this->sex,
            'fur' => $this->fur,
            'age' => $this->age,
            'vaccinations' => $this->vaccinations,
            'character' => $this->character,
            'state' => $this->state,
            'description' => $this->description,
            'show_image' => $show_image_path,
           /* 'gallery_images' => json_encode($gallery_images_paths),*/
            'gallery_images' => $gallery_images_paths,
            'internal_notes'=>$this->internal_notes,
            'modification_request'=>$this->modification_request,
            'published_animal'=>$this->published_animal?? false,
        ]);

        $admin = \App\Models\User::where('is_admin', '1')->first();

        \Mail::to($admin->email)->queue(new  \App\Mail\AnimalCreatedMail($animal));


        $this->redirect(route('pages::animals.index', ['locale' => app()->getLocale()]));
    }
};

/*
 * https://laravel.com/framework/docs/13.x/queues#creating-jobs
 * https://laravel.com/framework/docs/13.x/queues#dispatching-jobs
 *
 * */

<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProcessAnimalImage implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct( public string $gallery_image_path)
    {

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {


                $sizes = config('animalimage.sizes');
                $compression = config('animalimage.jpg_compression');


                $filename = basename($this->gallery_image_path); // = juste le nom de l'image sans les dossiers etc
                $image = Image::decode(          //marche pas avec read
                //Storage::disk('s3')->get($this->image_path)
                    Storage::disk('s3')->get($this->gallery_image_path)
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
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('animal_name');
            $table->string('species');
            $table->string('race');
            $table->string('sex');
            $table->string('fur');
            $table->string('age');
            $table->string('vaccinations');
            $table->string('character');
            $table->string('state');
            $table->text('description');
            $table->string('show_image')->nullable();
            $table->string('gallery_images')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};

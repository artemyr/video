<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->boolean('active')
                ->default(true);
            $table->string('image');
            $table->string('video')
                ->nullable();
            $table->string('size')
                ->nullable();
            $table->smallInteger('sort')
                ->default(500);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('sliders');
        }
    }
};

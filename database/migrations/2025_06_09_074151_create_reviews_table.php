<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('title')
                ->nullable();
            $table->text('description')
                ->nullable();
            $table->string('image');
            $table->smallInteger('sort')
                ->default(500);
            $table->boolean('active')
                ->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('reviews');
        }
    }
};

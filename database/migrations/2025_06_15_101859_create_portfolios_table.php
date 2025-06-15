<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title')
                ->nullable();
            $table->smallInteger('sort')
                ->default(500);
            $table->boolean('active')
                ->default(true);
            $table->string('image');
            $table->string('video');
            $table->string('size')
                ->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (!app()->isProduction()) {
            Schema::dropIfExists('portfolios');
        }
    }
};

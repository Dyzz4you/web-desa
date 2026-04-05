<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('population_statistics', function (Blueprint $table) {
            $table->id();
            $table->year('year');
            $table->unsignedInteger('total_population')->default(0);
            $table->unsignedInteger('male_count')->default(0);
            $table->unsignedInteger('female_count')->default(0);
            $table->unsignedInteger('family_count')->default(0);
            $table->unsignedInteger('birth_count')->default(0);
            $table->unsignedInteger('death_count')->default(0);
            $table->unsignedInteger('moved_in_count')->default(0);
            $table->unsignedInteger('moved_out_count')->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique('year');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('population_statistics');
    }
};
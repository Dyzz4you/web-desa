<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('budget_reports', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->year('year');
            $table->text('description')->nullable();
            $table->string('file')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('type', ['poster', 'pdf', 'report'])->default('poster');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['year', 'type', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('budget_reports');
    }
};
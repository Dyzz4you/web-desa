<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('village_profiles', function (Blueprint $table) {
            $table->longText('history')->nullable()->after('about');
            $table->longText('identity')->nullable()->after('history');
            $table->text('map_embed')->nullable()->after('google_maps_embed');
            $table->string('map_image')->nullable()->after('map_embed');
        });
    }

    public function down(): void
    {
        Schema::table('village_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'history',
                'identity',
                'map_embed',
                'map_image',
            ]);
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('widgets', function (Blueprint $table): void {
            $table->string('gallery_image_2')->nullable()->after('cover_image');
            $table->string('gallery_image_3')->nullable()->after('gallery_image_2');
        });
    }

    public function down(): void
    {
        Schema::table('widgets', function (Blueprint $table): void {
            $table->dropColumn(['gallery_image_2', 'gallery_image_3']);
        });
    }
};

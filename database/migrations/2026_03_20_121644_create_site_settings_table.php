<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('CRM Integrator');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('telegram_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('vk_link')->nullable();
            $table->string('max_link')->nullable();
            $table->string('teletype_link')->nullable();
            $table->string('address')->nullable();
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};

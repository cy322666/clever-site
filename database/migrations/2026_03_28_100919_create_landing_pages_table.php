<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_pages', function (Blueprint $table) {
            $table->id();
            $table->string('page_type')->default('service')->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('h1')->nullable();
            $table->text('excerpt')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('canonical_url')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft')->index();
            $table->unsignedInteger('sort_order')->default(0)->index();
            $table->json('sections');
            $table->json('related_slugs')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_pages');
    }
};

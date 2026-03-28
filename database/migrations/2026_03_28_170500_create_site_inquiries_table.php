<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->text('message')->nullable();
            $table->string('landing_slug')->nullable()->index();
            $table->string('landing_title')->nullable();
            $table->string('offer_type')->nullable();
            $table->string('page_url')->nullable();
            $table->string('status')->default('new')->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_inquiries');
    }
};

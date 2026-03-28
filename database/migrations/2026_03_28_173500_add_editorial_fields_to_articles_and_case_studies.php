<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('canonical_url')->nullable()->after('seo_description');
        });

        Schema::table('case_studies', function (Blueprint $table) {
            $table->text('metrics_block')->nullable()->after('result_block');
            $table->timestamp('published_at')->nullable()->after('status')->index();
            $table->string('canonical_url')->nullable()->after('seo_description');
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('canonical_url');
        });

        Schema::table('case_studies', function (Blueprint $table) {
            $table->dropColumn(['metrics_block', 'published_at', 'canonical_url']);
        });
    }
};

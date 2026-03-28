<?php

use App\Support\ArticleBlocks;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('articles')
            ->select(['id', 'title', 'full_content', 'content_blocks'])
            ->orderBy('id')
            ->get()
            ->each(function (object $article): void {
                $currentBlocks = is_string($article->content_blocks)
                    ? json_decode($article->content_blocks, true)
                    : $article->content_blocks;

                if (is_array($currentBlocks) && $currentBlocks !== []) {
                    $normalized = ArticleBlocks::normalize($currentBlocks);
                } else {
                    $normalized = filled($article->full_content)
                        ? ArticleBlocks::fromLegacyText((string) $article->full_content, $article->title)
                        : [];
                }

                if ($normalized === []) {
                    return;
                }

                DB::table('articles')
                    ->where('id', $article->id)
                    ->update([
                        'content_blocks' => json_encode($normalized, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
                        'updated_at' => now(),
                    ]);
            });
    }

    public function down(): void
    {
        //
    }
};

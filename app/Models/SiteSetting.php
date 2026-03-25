<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'phone',
        'email',
        'telegram_link',
        'youtube_link',
        'vk_link',
        'max_link',
        'teletype_link',
        'address',
        'hero_title',
        'hero_subtitle',
    ];
}

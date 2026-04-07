<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteInquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact',
        'message',
        'landing_slug',
        'landing_title',
        'offer_type',
        'page_url',
        'status',
        'ip_address',
        'user_agent',
    ];
}

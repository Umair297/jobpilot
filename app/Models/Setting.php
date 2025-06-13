<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'search_engine_indexing' => 'boolean',
        'google_analytics' => 'boolean',
    ];

    protected $appends = ['dark_logo_url', 'light_logo_url', 'favicon_image_url', 'app_pwa_icon_url'];

    public static function boot()
    {
        parent::boot();

        self::updated(function ($model) {
            forgetCache('setting');
        });
    }

    /**
     * Get the dark logo url.
     *
     * @return string
     */
    public function getDarkLogoUrlAttribute()
    {
        if (empty($this->dark_logo)) {
           return asset('backend/image/default.png');
        }

        return asset($this->dark_logo);
    }

    public function getLightLogoUrlAttribute()
    {
        if (empty($this->light_logo)) {
            return asset('backend/image/default.png');
        }

        return asset($this->light_logo);
    }

    public function getFaviconImageUrlAttribute()
    {
        if (empty($this->favicon_image)) {
           return asset('backend/image/default.png');
        }

        return asset($this->favicon_image);
    }

    public function getAppPwaIconUrlAttribute()
    {
        if (empty($this->app_pwa_icon)) {
            return asset('backend/image/default.png');
        }

        return asset($this->app_pwa_icon);
    }
}

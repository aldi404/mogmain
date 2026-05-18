<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePortfolio extends Model
{
    protected $fillable = ['name', 'description', 'thumbnail_image_path'];

    public function images()
    {
        return $this->hasMany(ServicePortfolioImage::class)->orderBy('sort_order');
    }
}

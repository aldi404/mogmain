<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePortfolioImage extends Model
{
    protected $fillable = ['service_portfolio_id', 'image_path', 'sort_order'];

    public function portfolio()
    {
        return $this->belongsTo(ServicePortfolio::class, 'service_portfolio_id');
    }
}

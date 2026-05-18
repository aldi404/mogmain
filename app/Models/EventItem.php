<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'client_name',
        'event_name',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
    }

    public function images()
    {
        return $this->hasMany(EventImage::class, 'event_item_id')->orderBy('sort_order');
    }
}

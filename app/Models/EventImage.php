<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_item_id',
        'image_path',
        'sort_order',
    ];

    public function event()
    {
        return $this->belongsTo(EventItem::class, 'event_item_id');
    }
}

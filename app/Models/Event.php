<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'event_type',
        'max_participants',
        'registration_fee',
        'banner_image',
        'status',
        'created_by'
    ];

    protected $casts = [
        'event_date' => 'date',
        'registration_fee' => 'decimal:2'
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function registrationForms()
    {
        return $this->hasMany(RegistrationForm::class);
    }

    public function activeRegistrationForm()
    {
        return $this->hasOne(RegistrationForm::class)->where('is_active', true);
    }
}

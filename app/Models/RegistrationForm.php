<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'form_title',
        'form_description',
        'is_active',
        'registration_start',
        'registration_end'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'registration_start' => 'datetime',
        'registration_end' => 'datetime'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function formFields()
    {
        return $this->hasMany(RegistrationFormField::class)->orderBy('field_order');
    }

    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }

    public function isRegistrationOpen()
    {
        $now = now();
        return $this->is_active &&
            $now >= $this->registration_start &&
            $now <= $this->registration_end;
    }
}

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
        'registration_end',
        'repeatable_config'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'registration_start' => 'datetime',
        'registration_end' => 'datetime',
        'repeatable_config' => 'array'
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

    public function hasRepeatableSection()
    {
        return !empty($this->repeatable_config) &&
            !empty($this->repeatable_config['sections']) &&
            is_array($this->repeatable_config['sections']) &&
            count($this->repeatable_config['sections']) > 0;
    }

    public function getRepeatableSections()
    {
        if (!$this->hasRepeatableSection()) {
            return [];
        }

        return $this->repeatable_config['sections'] ?? [];
    }
}
